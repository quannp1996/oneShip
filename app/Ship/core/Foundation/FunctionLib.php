<?php

namespace Apiato\Core\Foundation;

use Apiato\Core\Traits\CallableTrait;
use App\Containers\Settings\Actions\GetAllSettingsAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent as AgentAgent;
use Jenssegers\Agent\Facades\Agent;

class FunctionLib
{

    use CallableTrait;

    protected static $env;
    protected static $modules;
    public static $breadcrumb = [];
    protected static $defLang;
    protected static $dev = 'frontend';
    protected static $storage = [];
    protected static $days = array('Mon' => 'Thứ 2', 'Tue' => 'Thứ 3', 'Wed' => 'Thứ 4', 'Thu' => 'Thứ 5', 'Fri' => 'Thứ 6', 'Sat' => 'Thứ 7', 'Sun' => 'Chủ nhật');

    public static function set($k, $v)
    {
        self::$storage[$k] = $v;
    }

    public static function get($k, $def = null)
    {
        return isset(self::$storage[$k]) ? self::$storage[$k] : $def;
    }

    public static function appEnv()
    {
        if (empty(self::$env)) {
            //Load file config/module.php
            $app_env = self::$dev;
            if (str_contains(request()->getHost(), 'api.')) {
                $app_env = 'api';
            } elseif (str_contains(request()->getHost(), 'admin.')) {
                $app_env = 'admin';
            }
            if ($app_env != 'admin') {
            }

            self::$env = $app_env;
        }
        return self::$env;
    }

    public static function modules()
    {
        if (empty(self::$modules)) {
            self::$modules = config('module');
        }
        return self::$modules;
    }

    public static function module_config($key = '', $def = '')
    {
        //load module config
        $modules = self::modules();
        // dd($modules);

        //load env
        $env = self::appEnv();
        // if(isset($modules[$env]) && isset($modules[$env][$key])){
        //     return $modules[$env][$key];
        // }
        return $def;
    }

    public static function config($key = '', $def = '')
    {
        //load filename config
        $conf_name = self::module_config('config_name');
        $conf = config($conf_name, array());
        if (!empty($conf) && !empty($conf[$key])) {
            return $conf[$key];
        }
        return $def;
    }

    public function tplShareGlobal($module_dir = 'web', $settings = [])
    {
        //load config website
        if (empty($settings)) {
            $settings = $this->call('Settings@GetAllSettingsAction', ['Array', true]);
        }
        $curLang = app()->getLocale();
        $configs = config('basecontainer-container.' . $module_dir);
        $config2 = [
            'lang' => $curLang,
            'site_description' => !empty($settings['website']['description']) ? $settings['website']['description'] : '',
            'site_keyword' => !empty($settings['website']['keywords']) ? $settings['website']['keywords'] : '',
            'site_title' => !empty($settings['website']['site_title']) ? $settings['website']['site_title'] : (!empty($settings['website']['site_name']) ? $settings['website']['site_name'] : config('app.name')),
            'site_name' => !empty($settings['website']['site_name']) ? $settings['website']['site_name'] : config('app.name'),
            'favicon' => $configs['favicon'] ?? '',
            'site_media' => $configs['media'] ?? array(),
            'site_css' => $configs['css'] ?? array(),
            'site_css_override' => !empty($configs['override']) && !empty($configs['override']['css']) ? $configs['override']['css'] : [],
            'site_js' => $configs['js'] ?? array(),
            'site_js_override' => !empty($configs['override']) && !empty($configs['override']['js']) ? $configs['override']['js'] : [],
            'site_js_val' => [
                'SITE_NAME' => !empty($settings['website']['site_name']) ? $settings['website']['site_name'] : config('app.name'),
                'BASE_URL' => asset('/' . $module_dir) . (!empty($module_dir) ? '/' : ''),
                'PUBLIC_URL' => env('APP_URL'),
                'LANG' => $curLang,
                'tel' => @$settings['contact']['tel'],
                'hotline' => @$settings['contact']['hotline'],
                'email' => @$settings['contact']['email'],
                'isAdminUrl' => self::isAdminUrl() ? 1 : 0,
            ],
            'img_width' => !empty($settings['website']['img_width']) ? $settings['website']['img_width'] : 800,
            'img_height' => !empty($settings['website']['img_height']) ? $settings['website']['img_height'] : 800,
        ];
        if (!empty($config)) {
            $config += $config2;
        } else {
            $config = $config2;
        }

        if (is_array($settings) && !empty($settings)) {
            $config += $settings;
        }
        if (empty($config['version'])) {
            $config['version'] = env('APP_VER');
        }
        if (empty($config['site_name'])) {
            $config['site_name'] = config('app.name');
        }
        return $config;
    }

    public function getSeo($module_dir = '', $data = [])
    {
        if (empty($data)) {
            $data = $this->tplShareGlobal($module_dir);
        }
        $return = [];
        if (!empty($data)) {
            $imageSeo = !empty($data['website']['image_seo']) ? (UrlLib::isUrl($data['website']['image_seo']) ? $data['website']['image_seo'] : \ImageURL::getImageUrl($data['website']['image_seo'], 'setting', 'seo')) : '';
            $title = @$data['site_title'];
            $description = @$data['website']['description'];
            $keywords = @$data['website']['keywords'];
            $url = url()->current();
            $facebookAppID = env('AUTH_FACEBOOK_CLIENT_ID');
            $img_width = @$data['img_width'] ?? 800;
            $img_height = @$data['img_height'] ?? 800;

            $return['facebook_meta'] = '
<meta name="description" content="' . $description . '"/>
<meta name="keywords" content="' . $keywords . '"/>
<meta property="fb:app_id" content="' . $facebookAppID . '" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:title" content="' . $title . '" />
<meta property="og:description" content="' . $description . '" />
<meta property="og:url" content="' . $url . '" />
<meta property="og:site_name" content="' . $title . '" />
<meta property="og:type" content="website" />
<meta property="og:image" content="' . $imageSeo . '" />
<meta property="og:image:alt" content="' . $title . '" />
<meta property="og:image:width" content="'. $img_width .'" />
<meta property="og:image:height" content="'. $img_height .'" />
            ';
            $return['twitter_meta'] = '
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="' . $description . '" />
<meta name="twitter:title" content="' . $title . '" />
<meta name="twitter:image" content="' . $imageSeo . '" />
<meta name="twitter:site" content=”' . $url . '” />
            ';
            $return['g_meta'] = '
<meta itemprop="name" content="' . $title . '" />
<meta itemprop="description" content="' . $description . '" />
<meta itemprop="image" content="' . $imageSeo . '">
            ';
        }
        return $return;
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    public static function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

    public static function addBreadcrumb($title = '', $link = '', $def = true, $folder = 'admin')
    {
        if ($title == '' && $link == '') {
            $defVal = self::defaultBreadcrumb($folder);
            $title = $defVal['title'];
            $link = $defVal['link'];
        } elseif (empty(self::$breadcrumb) && $def) {
            self::addBreadcrumb($title, $link, $def, $folder);
        }
        $key = md5($link != '' ? $link : $title);
        self::$breadcrumb[$key] = array(
            'title' =>    ucwords($title),
            'link'    =>    $link
        );

        return [
            'title' =>    ucwords($title),
            'link'    =>    $link
        ];
    }

    public static function defaultBreadcrumb($folder = '')
    {
        if (empty($folder)) {
            $folder = self::module_config('folder_name');
        }
        return [
            'folder' => $folder,
            'title' => 'Home',
            'link' => route($folder == 'admin' ? 'get_admin_dashboard_page' : 'home')
        ];
    }

    public static function renderBreadcrumb($extraCommand = [], $noExtra = false, $viewMake = '', $folder = 'admin')
    {
        $html = '';
        if (!empty(self::$breadcrumb)) {
            $defVal = self::defaultBreadcrumb($folder);
            if ($defVal['folder'] == 'admin' && !$noExtra && empty($extraCommand)) {
                $routeName = \Route::current()->getName();
                $adminIgnoreKey = ['admin.config', 'admin.home', 'home', 'admin.gallery', 'admin.comment_post', 'admin.dashboard'];
                if (\Route::has($routeName . '.add') && !in_array($routeName, $adminIgnoreKey)) {
                    $key = explode('.', $routeName);
                    $size = count($key);
                    if ($size >= 2) {
                        if ($size > 2) {
                            $routeName = explode('.', $routeName);
                            $routeName = array_chunk($routeName, 2);
                            $routeName = implode('.', $routeName[0]);
                        }
                        $extraCommand = [
                            [
                                'title' => 'Thêm mới',
                                'link' => $routeName . '.add',
                                'icon' => 'icon-plus',
                                'perm' => $key[1] . '-add'
                            ]
                        ];
                    }
                }
            }
            $html = \View::make($viewMake != '' ? $viewMake : 'basecontainer::' . $folder . '.layouts.components.breadcrumb', [
                'breadcrumb' => self::$breadcrumb,
                'defBr' => $defVal,
                'extraCommand' => $extraCommand
            ])->render();
        }
        return $html;
    }

    public static function ajaxRespond($success = true, $msg = '', $data = [])
    {
        return [
            'error' => $success ? 0 : 1,
            'msg' => $msg,
            ($success ? 'data' : 'code') => $data
        ];
    }

    public static function ajaxRespondV2($success = true, $msg = '', $data = [], $status = 200)
    {
        return response()
            //            ->header('Access-Control-Allow-Origin',"*")
            //            ->header("Access-Control-Allow-Headers","Authorization,Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers")
            ->json([
                'error' => $success ? 0 : 1,
                'msg' => $msg,
                ($success ? 'data' : 'code') => $data
            ], $status);
    }

    public static function siteTitle($title = '', $def = '', $is_admin = false)
    {
        $host = \Request::getHost();
        $title = trim($title != '' ? $title : $def);
        if ($is_admin) {
            return '<title>' . ($title == '' ? $host : ($title . ' | ' . $host)) . '</title>';
        }
        return '<title>' . ($title == '' ? $host : ($title . ' | ' . $host)) . '</title>';
    }

    public static function condition($pattern)
    {
        if (is_array($pattern) && !empty($pattern)) {
            $cond = [];
            foreach ($pattern as $p) {
                $p = explode(' ', $p);
                $c = count($p);
                if ($c >= 3) {
                    if ($c > 3 && str_contains(strtolower($p[1]), 'like')) {
                        $tmp = [array_shift($p)];
                        $tmp[] = array_shift($p);
                        $tmp[] = implode(' ', $p);
                        $p = $tmp;
                    }
                    $cond[] = $p;
                }
            }
            if (!empty($cond)) {
                return $cond;
            }
        }
        return false;
    }

    public static function getLanguageKey()
    {
        return '_lang';
    }

    public static function getDefaultLang()
    {
        $segment = \Request::segment(1);

        $langs = app(LanguageRepositoryContract::class)->getLanguages();
        $langs = self::replace_key_by_val($langs, 'short_code');

        if (in_array($segment, array_keys($langs))) {
            \App::setLocale($segment);
            self::$defLang = $segment;
        }

        if (empty(self::$defLang)) {
            $default = app(LanguageRepositoryContract::class)->defaultLanguage()['short_code'];
            self::$defLang = self::getCookie(self::getLanguageKey(), $default, true, false);
            self::$defLang = explode('|', self::$defLang);
        }
        // else {
        //     if(empty(self::$defLang)){
        //         self::$defLang = self::getCookie(self::getLanguageKey(), env('APP_LANG'),true,false);
        //         self::$defLang = explode('|',self::$defLang);
        //     }
        // }
        return is_array(self::$defLang) ? (count(self::$defLang) > 1 ? self::$defLang[1] : self::$defLang[0]) : self::$defLang;
    }

    public function getCookie($key, $def = '', $decrypt = true, $unserialize = true)
    {
        $cookieVal = Cookie::get($key);
        if (empty($cookieVal)) {
            return $def;
        }
        // $backtrace = debug_backtrace();
        // dump($backtrace ,$decrypt,$key,$cookieVal,config('app.locale'));
        return $decrypt ? \Crypt::decrypt($cookieVal, $unserialize) : $cookieVal;
    }

    public static function is_valid_email($email = '')
    {
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", strtolower(trim($email)));
    }

    public static function is_mobile($value = '')
    {
        return preg_match('#^(01([0-9]{2})|09[0-9]|08[0-9]|07[0-9]|05[0-9]|03[0-9])(\d{7})$#', $value);
    }

    public static function numberFormat($number = 0)
    {
        if ($number >= 1000) {
            return number_format($number, 0, ',', '.');
        }
        return $number;
    }

    public static function priceFormat($price = 0, $currency = 'VNĐ')
    {
        if ($currency === '') {
        }
        return self::numberFormat($price) . ($currency ? " $currency" : '');
    }

    public static function dateFormat($time = 0, $format = 'd/m - H:i', $vietnam = false, $show_time = false)
    {
        if (!is_int($time)) {
            $time = date_create($time)->getTimestamp();
        }
        $return = date($format, $time);
        if ($vietnam) {
            $return = ($show_time ? date('H:i - ', $time) : '') . self::$days[date('D', $time)] . ', ngày ' . date('d/m/Y', $time);
        }
        return $return;
    }

    public static function getMonthsOfTwoDate($start, $end)
    {
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $start);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $end);
        $diff_in_months = $to->diffInMonths($from);
        return $diff_in_months;
    }

    public static function dateFromObj($date, $format = 'd/m/Y H:i')
    {
        $dateCarbon =  new Carbon($date, 'Asia/Ho_Chi_Minh');
        return $dateCarbon->format($format);
    }

    public static function getTimestamp($time = '')
    {
        return date_create($time)->getTimestamp();
    }

    public static function roundedNumber($number = 0, $condition = 1000) // Mặc định là làm tròn đến hàng nghinf
    {
        return ceil(($number / $condition) * $condition);
    }

    public static function getTimestampFromVNDate($str_date = '', $end = false)
    {
        $time_str = str_replace('/', '-', $str_date);
        if ($end) {
            $time_str .= " 23:59:59";
        }
        return strtotime($time_str);
    }

    public static function getCarbonFromVNDate($str_date = '', $end = false)
    {
        $time_str = str_replace('/', '-', $str_date);
        try {
            return $time_str ? Carbon::parse($time_str) : Carbon::createFromTimestamp(time());
        } catch (\Exception $e) {
            return Carbon::createFromTimestamp(time());
        }
    }

    public static function duration_time($time)
    {
        if ($time >= 60) {
            $hour = floor($time / 60);
            $min = $time - $hour * 60;
            return $hour . 'h' . ($min > 0 ? $min : '0') . 'm';
        }
        return $time;
    }

    public static function str_limit($str, $limit = 60, $strip_tags = true)
    {
        if ($strip_tags) {
            $str = trim(strip_tags($str));
        }
        if (mb_strlen($str, "utf-8") > $limit) {
            $surfix = "...";
            $strTmp = mb_substr($str, 0, $limit, "utf-8");
            $intPos = mb_strrpos($strTmp, " ", 0, "utf-8");
            $str = mb_substr($strTmp, 0, $intPos, 'utf-8') . $surfix;
        }
        return $str;
    }

    static function stripUnicode($str = '')
    {
        if ($str != '') {
            $marTViet = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ");
            $marKoDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D");
            $str = str_replace($marTViet, $marKoDau, $str);
        }
        return $str;
    }

    static function getDefaultVal($arr, $key, $def = '')
    {
        if (!empty($arr[$key])) {
            return $arr[$key];
        }
        return $def;
    }

    public static function can($permArr = false, $keyCheck = '', $key = '')
    {
        if ($key != '') {
            $permArr = self::get('perm-' . $key);
            if (empty($permArr)) {
                $permArr = \Role::getPermOfUserByKey($key);
                self::set('perm-' . $key, $permArr);
            }
        }
        if (!empty($permArr) && !empty($keyCheck) && !empty($permArr[$keyCheck])) {
            return $permArr[$keyCheck];
        }
        return false;
    }

    public static function isAdminUrl()
    {
        return Str::contains(request()->fullUrl(), 'admin.');
    }
    public static function getLinkAttribute($extra_link)
    {
        $locale = config('apiato.using_locale_segment') ? app()->getLocale() . '/' : null;
        if (!empty($extra_link)) {
            if (filter_var($extra_link, FILTER_VALIDATE_URL)) return ($extra_link);

            return url($locale . self::trimFirstNLastSlash($extra_link)) ?? '#';

        }
    }
    public static function trimFirstNLastSlash($text)
    {
        if (empty($text)) return null;

        $text = ltrim($text, "/");
        return rtrim($text, "/");
    }

    public static function addMedia($src = '', $version = '')
    {
        $html = '';
        if (!empty($src)) {
            if (empty($version)) {
                $version = rand(); //$config['version'];
            }
            $link = !(filter_var($src, FILTER_VALIDATE_URL) === FALSE) ? $src : asset($src);
            $ext = pathinfo($link, PATHINFO_EXTENSION);
            if (empty($ext)) {
                $html = '<script type="text/javascript" src="' . $link . '?ver=' . $version . '"></script>';
            } else {
                switch ($ext) {
                    case 'js':
                    case 'ok':
                        $html = '<script type="text/javascript" src="' . $link . '?ver=' . $version . '"></script>';
                        break;
                    case 'css':
                        $html = '<link href="' . $link . '?ver=' . $version . '" rel="stylesheet">';
                        break;
                    case 'png':
                    case 'jpg':
                    case 'ico':
                    case 'gif':
                        $html = '<link href="' . $link . '?ver=' . $version . '" rel="shortcut icon">';
                        break;
                }
            }
        }
        return $html;
    }

    public static function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    static function unique_multidim_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public static function getHash($algo, $data, $key)
    {
        return hash_hmac($algo, $data, $key);
    }

    /*
	 * Chuyen value => key va giu nguyen value, ham nay ko giong array_flip
	 * @param array $arr mang can chuyen value => key
	 * @pa
	 */
    static function replace_key_by_val($arr = [], $key_str = '')
    {
        if ($arr) {
            $temp = [];
            foreach ($arr as $k => $v) {
                if (is_array($v)) {
                    $temp[$v[$key_str]] = $v;
                } else {
                    $temp[$v[$key_str]] = $v;
                }
            }
            $arr = $temp;
        }
        return $arr;
    }

    public static function makeToken($content, $key = 'myToken is !@#$HG@@#')
    {
        $content = json_encode(['c' => $content, 'k' => $key]);
        return md5($content);
    }

    public static function validToken($content, $token, $key = 'myToken is !@#$HG@@#')
    {
        return !empty($content) && (self::makeToken($content, $key) == $token);
    }

    public static function formatSizeUnits($bytes = 0): string
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public static function getIconGallery($icon = ''): string
    {
        if (Str::contains($icon, 'folder')) {
            return 'fa fa-folder';
        }

        return 'fa fa-file-' . $icon . '-o';
    }

    public static function selectCombobox($inputComparseValue, $currentLoopItemValue): string
    {
        if (isset($inputComparseValue) && $inputComparseValue == $currentLoopItemValue) {
            return 'selected';
        }

        return '';
    }

    public static function getUrlFromRoute($routeName = ''): string
    {
        if (!empty($routeName)) {
            try {
                return route($routeName);
            } catch (\Exception $e) {
            }
        }
        return '';
    }

    public static function getActionController()
    {
        return request()->route()->getActionMethod();
    }

    public static function isDontUseShareData(array $listMethodDontUse = [], $request = null): bool
    {
        if (!request()->ajax()) {
            $methods = self::getActionController();
            return in_array($methods, $listMethodDontUse);
        }

        return true;
    }

    public static function isMobile($settings = null): bool
    {

        // $settings = empty($settings) ? app(GetAllSettingsAction::class)->run('Array', true) : $settings;
        // $isMobile = false;
        // if ($settings['website']['mobile_active']) {
        //     $isMobile = self::mobileDeviceDetect();
        //     if (is_array($isMobile)) {
        //         $isMobile = !empty($isMobile) && $isMobile[0];
        //     }
        // }

        // return $isMobile;
        $agent = new AgentAgent();
        return $agent->isMobile();
    }

    public static function mobileDeviceDetect($iphone = true, $ipad = true, $android = true, $opera = true, $blackberry = true, $palm = true, $windows = true, $mobileredirect = false, $desktopredirect = false)
    {
        $mobile_browser   = false; // set mobile browser as false till we can prove otherwise
        $user_agent       = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''; // get the user agent value - this should be cleaned to ensure no nefarious input gets executed
        $accept           = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : ''; // get the content accept value - this should be cleaned to ensure no nefarious input gets executed

        switch (true) { // using a switch against the following statements which could return true is more efficient than the previous method of using if statements

            case (preg_match('/ipad/i', $user_agent)); // we find the word ipad in the user agent
                $mobile_browser = $ipad; // mobile browser is either true or false depending on the setting of ipad when calling the function
                $status = 'Apple iPad';
                if (substr($ipad, 0, 4) == 'http') { // does the value of ipad resemble a url
                    $mobileredirect = $ipad; // set the mobile redirect url to the url value stored in the ipad value
                } // ends the if for ipad being a url
                break; // break out and skip the rest if we've had a match on the ipad // this goes before the iphone to catch it else it would return on the iphone instead

            case (preg_match('/ipod/i', $user_agent) || preg_match('/iphone/i', $user_agent)); // we find the words iphone or ipod in the user agent
                $mobile_browser = $iphone; // mobile browser is either true or false depending on the setting of iphone when calling the function
                $status = 'Apple';
                if (substr($iphone, 0, 4) == 'http') { // does the value of iphone resemble a url
                    $mobileredirect = $iphone; // set the mobile redirect url to the url value stored in the iphone value
                } // ends the if for iphone being a url
                break; // break out and skip the rest if we've had a match on the iphone or ipod

            case (preg_match('/android/i', $user_agent));  // we find android in the user agent
                $mobile_browser = $android; // mobile browser is either true or false depending on the setting of android when calling the function
                $status = 'Android';
                if (substr($android, 0, 4) == 'http') { // does the value of android resemble a url
                    $mobileredirect = $android; // set the mobile redirect url to the url value stored in the android value
                } // ends the if for android being a url
                break; // break out and skip the rest if we've had a match on android

            case (preg_match('/opera mini/i', $user_agent)); // we find opera mini in the user agent
                $mobile_browser = $opera; // mobile browser is either true or false depending on the setting of opera when calling the function
                $status = 'Opera';
                if (substr($opera, 0, 4) == 'http') { // does the value of opera resemble a rul
                    $mobileredirect = $opera; // set the mobile redirect url to the url value stored in the opera value
                } // ends the if for opera being a url
                break; // break out and skip the rest if we've had a match on opera

            case (preg_match('/blackberry/i', $user_agent)); // we find blackberry in the user agent
                $mobile_browser = $blackberry; // mobile browser is either true or false depending on the setting of blackberry when calling the function
                $status = 'Blackberry';
                if (substr($blackberry, 0, 4) == 'http') { // does the value of blackberry resemble a rul
                    $mobileredirect = $blackberry; // set the mobile redirect url to the url value stored in the blackberry value
                } // ends the if for blackberry being a url
                break; // break out and skip the rest if we've had a match on blackberry

            case (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine)/i', $user_agent)); // we find palm os in the user agent - the i at the end makes it case insensitive
                $mobile_browser = $palm; // mobile browser is either true or false depending on the setting of palm when calling the function
                $status = 'Palm';
                if (substr($palm, 0, 4) == 'http') { // does the value of palm resemble a rul
                    $mobileredirect = $palm; // set the mobile redirect url to the url value stored in the palm value
                } // ends the if for palm being a url
                break; // break out and skip the rest if we've had a match on palm os

            case (preg_match('/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile)/i', $user_agent)); // we find windows mobile in the user agent - the i at the end makes it case insensitive
                $mobile_browser = $windows; // mobile browser is either true or false depending on the setting of windows when calling the function
                $status = 'Windows Smartphone';
                if (substr($windows, 0, 4) == 'http') { // does the value of windows resemble a rul
                    $mobileredirect = $windows; // set the mobile redirect url to the url value stored in the windows value
                } // ends the if for windows being a url
                break; // break out and skip the rest if we've had a match on windows

            case (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320|vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo)/i', $user_agent)); // check if any of the values listed create a match on the user agent - these are some of the most common terms used in agents to identify them as being mobile devices - the i at the end makes it case insensitive
                $mobile_browser = true; // set mobile browser to true
                $status = 'Mobile matched on piped preg_match';
                break; // break out and skip the rest if we've preg_match on the user agent returned true

            case ((strpos($accept, 'text/vnd.wap.wml') > 0) || (strpos($accept, 'application/vnd.wap.xhtml+xml') > 0)); // is the device showing signs of support for text/vnd.wap.wml or application/vnd.wap.xhtml+xml
                $mobile_browser = true; // set mobile browser to true
                $status = 'Mobile matched on content accept header';
                break; // break out and skip the rest if we've had a match on the content accept headers

            case (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])); // is the device giving us a HTTP_X_WAP_PROFILE or HTTP_PROFILE header - only mobile devices would do this
                $mobile_browser = true; // set mobile browser to true
                $status = 'Mobile matched on profile headers being set';
                break; // break out and skip the final step if we've had a return true on the mobile specfic headers

            case (in_array(strtolower(substr($user_agent, 0, 4)), array('1207' => '1207', '3gso' => '3gso', '4thp' => '4thp', '501i' => '501i', '502i' => '502i', '503i' => '503i', '504i' => '504i', '505i' => '505i', '506i' => '506i', '6310' => '6310', '6590' => '6590', '770s' => '770s', '802s' => '802s', 'a wa' => 'a wa', 'acer' => 'acer', 'acs-' => 'acs-', 'airn' => 'airn', 'alav' => 'alav', 'asus' => 'asus', 'attw' => 'attw', 'au-m' => 'au-m', 'aur ' => 'aur ', 'aus ' => 'aus ', 'abac' => 'abac', 'acoo' => 'acoo', 'aiko' => 'aiko', 'alco' => 'alco', 'alca' => 'alca', 'amoi' => 'amoi', 'anex' => 'anex', 'anny' => 'anny', 'anyw' => 'anyw', 'aptu' => 'aptu', 'arch' => 'arch', 'argo' => 'argo', 'bell' => 'bell', 'bird' => 'bird', 'bw-n' => 'bw-n', 'bw-u' => 'bw-u', 'beck' => 'beck', 'benq' => 'benq', 'bilb' => 'bilb', 'blac' => 'blac', 'c55/' => 'c55/', 'cdm-' => 'cdm-', 'chtm' => 'chtm', 'capi' => 'capi', 'cond' => 'cond', 'craw' => 'craw', 'dall' => 'dall', 'dbte' => 'dbte', 'dc-s' => 'dc-s', 'dica' => 'dica', 'ds-d' => 'ds-d', 'ds12' => 'ds12', 'dait' => 'dait', 'devi' => 'devi', 'dmob' => 'dmob', 'doco' => 'doco', 'dopo' => 'dopo', 'el49' => 'el49', 'erk0' => 'erk0', 'esl8' => 'esl8', 'ez40' => 'ez40', 'ez60' => 'ez60', 'ez70' => 'ez70', 'ezos' => 'ezos', 'ezze' => 'ezze', 'elai' => 'elai', 'emul' => 'emul', 'eric' => 'eric', 'ezwa' => 'ezwa', 'fake' => 'fake', 'fly-' => 'fly-', 'fly_' => 'fly_', 'g-mo' => 'g-mo', 'g1 u' => 'g1 u', 'g560' => 'g560', 'gf-5' => 'gf-5', 'grun' => 'grun', 'gene' => 'gene', 'go.w' => 'go.w', 'good' => 'good', 'grad' => 'grad', 'hcit' => 'hcit', 'hd-m' => 'hd-m', 'hd-p' => 'hd-p', 'hd-t' => 'hd-t', 'hei-' => 'hei-', 'hp i' => 'hp i', 'hpip' => 'hpip', 'hs-c' => 'hs-c', 'htc ' => 'htc ', 'htc-' => 'htc-', 'htca' => 'htca', 'htcg' => 'htcg', 'htcp' => 'htcp', 'htcs' => 'htcs', 'htct' => 'htct', 'htc_' => 'htc_', 'haie' => 'haie', 'hita' => 'hita', 'huaw' => 'huaw', 'hutc' => 'hutc', 'i-20' => 'i-20', 'i-go' => 'i-go', 'i-ma' => 'i-ma', 'i230' => 'i230', 'iac' => 'iac', 'iac-' => 'iac-', 'iac/' => 'iac/', 'ig01' => 'ig01', 'im1k' => 'im1k', 'inno' => 'inno', 'iris' => 'iris', 'jata' => 'jata', 'java' => 'java', 'kddi' => 'kddi', 'kgt' => 'kgt', 'kgt/' => 'kgt/', 'kpt ' => 'kpt ', 'kwc-' => 'kwc-', 'klon' => 'klon', 'lexi' => 'lexi', 'lg g' => 'lg g', 'lg-a' => 'lg-a', 'lg-b' => 'lg-b', 'lg-c' => 'lg-c', 'lg-d' => 'lg-d', 'lg-f' => 'lg-f', 'lg-g' => 'lg-g', 'lg-k' => 'lg-k', 'lg-l' => 'lg-l', 'lg-m' => 'lg-m', 'lg-o' => 'lg-o', 'lg-p' => 'lg-p', 'lg-s' => 'lg-s', 'lg-t' => 'lg-t', 'lg-u' => 'lg-u', 'lg-w' => 'lg-w', 'lg/k' => 'lg/k', 'lg/l' => 'lg/l', 'lg/u' => 'lg/u', 'lg50' => 'lg50', 'lg54' => 'lg54', 'lge-' => 'lge-', 'lge/' => 'lge/', 'lynx' => 'lynx', 'leno' => 'leno', 'm1-w' => 'm1-w', 'm3ga' => 'm3ga', 'm50/' => 'm50/', 'maui' => 'maui', 'mc01' => 'mc01', 'mc21' => 'mc21', 'mcca' => 'mcca', 'meri' => 'meri', 'mio8' => 'mio8', 'mioa' => 'mioa', 'mo01' => 'mo01', 'mo02' => 'mo02', 'mode' => 'mode', 'modo' => 'modo', 'mot ' => 'mot ', 'mot-' => 'mot-', 'mt50' => 'mt50', 'mtp1' => 'mtp1', 'mtv ' => 'mtv ', 'mate' => 'mate', 'maxo' => 'maxo', 'merc' => 'merc', 'mits' => 'mits', 'mobi' => 'mobi', 'motv' => 'motv', 'mozz' => 'mozz', 'n100' => 'n100', 'n101' => 'n101', 'n102' => 'n102', 'n202' => 'n202', 'n203' => 'n203', 'n300' => 'n300', 'n302' => 'n302', 'n500' => 'n500', 'n502' => 'n502', 'n505' => 'n505', 'n700' => 'n700', 'n701' => 'n701', 'n710' => 'n710', 'nec-' => 'nec-', 'nem-' => 'nem-', 'newg' => 'newg', 'neon' => 'neon', 'netf' => 'netf', 'noki' => 'noki', 'nzph' => 'nzph', 'o2 x' => 'o2 x', 'o2-x' => 'o2-x', 'opwv' => 'opwv', 'owg1' => 'owg1', 'opti' => 'opti', 'oran' => 'oran', 'p800' => 'p800', 'pand' => 'pand', 'pg-1' => 'pg-1', 'pg-2' => 'pg-2', 'pg-3' => 'pg-3', 'pg-6' => 'pg-6', 'pg-8' => 'pg-8', 'pg-c' => 'pg-c', 'pg13' => 'pg13', 'phil' => 'phil', 'pn-2' => 'pn-2', 'pt-g' => 'pt-g', 'palm' => 'palm', 'pana' => 'pana', 'pire' => 'pire', 'pock' => 'pock', 'pose' => 'pose', 'psio' => 'psio', 'qa-a' => 'qa-a', 'qc-2' => 'qc-2', 'qc-3' => 'qc-3', 'qc-5' => 'qc-5', 'qc-7' => 'qc-7', 'qc07' => 'qc07', 'qc12' => 'qc12', 'qc21' => 'qc21', 'qc32' => 'qc32', 'qc60' => 'qc60', 'qci-' => 'qci-', 'qwap' => 'qwap', 'qtek' => 'qtek', 'r380' => 'r380', 'r600' => 'r600', 'raks' => 'raks', 'rim9' => 'rim9', 'rove' => 'rove', 's55/' => 's55/', 'sage' => 'sage', 'sams' => 'sams', 'sc01' => 'sc01', 'sch-' => 'sch-', 'scp-' => 'scp-', 'sdk/' => 'sdk/', 'se47' => 'se47', 'sec-' => 'sec-', 'sec0' => 'sec0', 'sec1' => 'sec1', 'semc' => 'semc', 'sgh-' => 'sgh-', 'shar' => 'shar', 'sie-' => 'sie-', 'sk-0' => 'sk-0', 'sl45' => 'sl45', 'slid' => 'slid', 'smb3' => 'smb3', 'smt5' => 'smt5', 'sp01' => 'sp01', 'sph-' => 'sph-', 'spv ' => 'spv ', 'spv-' => 'spv-', 'sy01' => 'sy01', 'samm' => 'samm', 'sany' => 'sany', 'sava' => 'sava', 'scoo' => 'scoo', 'send' => 'send', 'siem' => 'siem', 'smar' => 'smar', 'smit' => 'smit', 'soft' => 'soft', 'sony' => 'sony', 't-mo' => 't-mo', 't218' => 't218', 't250' => 't250', 't600' => 't600', 't610' => 't610', 't618' => 't618', 'tcl-' => 'tcl-', 'tdg-' => 'tdg-', 'telm' => 'telm', 'tim-' => 'tim-', 'ts70' => 'ts70', 'tsm-' => 'tsm-', 'tsm3' => 'tsm3', 'tsm5' => 'tsm5', 'tx-9' => 'tx-9', 'tagt' => 'tagt', 'talk' => 'talk', 'teli' => 'teli', 'topl' => 'topl', 'hiba' => 'hiba', 'up.b' => 'up.b', 'upg1' => 'upg1', 'utst' => 'utst', 'v400' => 'v400', 'v750' => 'v750', 'veri' => 'veri', 'vk-v' => 'vk-v', 'vk40' => 'vk40', 'vk50' => 'vk50', 'vk52' => 'vk52', 'vk53' => 'vk53', 'vm40' => 'vm40', 'vx98' => 'vx98', 'virg' => 'virg', 'vite' => 'vite', 'voda' => 'voda', 'vulc' => 'vulc', 'w3c ' => 'w3c ', 'w3c-' => 'w3c-', 'wapj' => 'wapj', 'wapp' => 'wapp', 'wapu' => 'wapu', 'wapm' => 'wapm', 'wig ' => 'wig ', 'wapi' => 'wapi', 'wapr' => 'wapr', 'wapv' => 'wapv', 'wapy' => 'wapy', 'wapa' => 'wapa', 'waps' => 'waps', 'wapt' => 'wapt', 'winc' => 'winc', 'winw' => 'winw', 'wonu' => 'wonu', 'x700' => 'x700', 'xda2' => 'xda2', 'xdag' => 'xdag', 'yas-' => 'yas-', 'your' => 'your', 'zte-' => 'zte-', 'zeto' => 'zeto', 'acs-' => 'acs-', 'alav' => 'alav', 'alca' => 'alca', 'amoi' => 'amoi', 'aste' => 'aste', 'audi' => 'audi', 'avan' => 'avan', 'benq' => 'benq', 'bird' => 'bird', 'blac' => 'blac', 'blaz' => 'blaz', 'brew' => 'brew', 'brvw' => 'brvw', 'bumb' => 'bumb', 'ccwa' => 'ccwa', 'cell' => 'cell', 'cldc' => 'cldc', 'cmd-' => 'cmd-', 'dang' => 'dang', 'doco' => 'doco', 'eml2' => 'eml2', 'eric' => 'eric', 'fetc' => 'fetc', 'hipt' => 'hipt', 'http' => 'http', 'ibro' => 'ibro', 'idea' => 'idea', 'ikom' => 'ikom', 'inno' => 'inno', 'ipaq' => 'ipaq', 'jbro' => 'jbro', 'jemu' => 'jemu', 'java' => 'java', 'jigs' => 'jigs', 'kddi' => 'kddi', 'keji' => 'keji', 'kyoc' => 'kyoc', 'kyok' => 'kyok', 'leno' => 'leno', 'lg-c' => 'lg-c', 'lg-d' => 'lg-d', 'lg-g' => 'lg-g', 'lge-' => 'lge-', 'libw' => 'libw', 'm-cr' => 'm-cr', 'maui' => 'maui', 'maxo' => 'maxo', 'midp' => 'midp', 'mits' => 'mits', 'mmef' => 'mmef', 'mobi' => 'mobi', 'mot-' => 'mot-', 'moto' => 'moto', 'mwbp' => 'mwbp', 'mywa' => 'mywa', 'nec-' => 'nec-', 'newt' => 'newt', 'nok6' => 'nok6', 'noki' => 'noki', 'o2im' => 'o2im', 'opwv' => 'opwv', 'palm' => 'palm', 'pana' => 'pana', 'pant' => 'pant', 'pdxg' => 'pdxg', 'phil' => 'phil', 'play' => 'play', 'pluc' => 'pluc', 'port' => 'port', 'prox' => 'prox', 'qtek' => 'qtek', 'qwap' => 'qwap', 'rozo' => 'rozo', 'sage' => 'sage', 'sama' => 'sama', 'sams' => 'sams', 'sany' => 'sany', 'sch-' => 'sch-', 'sec-' => 'sec-', 'send' => 'send', 'seri' => 'seri', 'sgh-' => 'sgh-', 'shar' => 'shar', 'sie-' => 'sie-', 'siem' => 'siem', 'smal' => 'smal', 'smar' => 'smar', 'sony' => 'sony', 'sph-' => 'sph-', 'symb' => 'symb', 't-mo' => 't-mo', 'teli' => 'teli', 'tim-' => 'tim-', 'tosh' => 'tosh', 'treo' => 'treo', 'tsm-' => 'tsm-', 'upg1' => 'upg1', 'upsi' => 'upsi', 'vk-v' => 'vk-v', 'voda' => 'voda', 'vx52' => 'vx52', 'vx53' => 'vx53', 'vx60' => 'vx60', 'vx61' => 'vx61', 'vx70' => 'vx70', 'vx80' => 'vx80', 'vx81' => 'vx81', 'vx83' => 'vx83', 'vx85' => 'vx85', 'wap-' => 'wap-', 'wapa' => 'wapa', 'wapi' => 'wapi', 'wapp' => 'wapp', 'wapr' => 'wapr', 'webc' => 'webc', 'whit' => 'whit', 'winw' => 'winw', 'wmlb' => 'wmlb', 'xda-' => 'xda-',))); // check against a list of trimmed user agents to see if we find a match
                $mobile_browser = true; // set mobile browser to true
                $status = 'Mobile matched on in_array';
                break; // break even though it's the last statement in the switch so there's nothing to break away from but it seems better to include it than exclude it

            default;
                $mobile_browser = false; // set mobile browser to false
                $status = 'Desktop / full capability browser';
                break; // break even though it's the last statement in the switch so there's nothing to break away from but it seems better to include it than exclude it

        } // ends the switch

        // tell adaptation services (transcoders and proxies) to not alter the content based on user agent as it's already being managed by this script, some of them suck though and will disregard this....
        // header('Cache-Control: no-transform'); // http://mobiforge.com/developing/story/setting-http-headers-advise-transcoding-proxies
        // header('Vary: User-Agent, Accept'); // http://mobiforge.com/developing/story/setting-http-headers-advise-transcoding-proxies

        // if redirect (either the value of the mobile or desktop redirect depending on the value of $mobile_browser) is true redirect else we return the status of $mobile_browser
        if ($redirect = ($mobile_browser == true) ? $mobileredirect : $desktopredirect) {
            header('Location: ' . $redirect); // redirect to the right url for this device
            exit;
        } else {
            // a couple of folkas have asked about the status - that's there to help you debug and understand what the script is doing
            if ($mobile_browser == '') {
                return $mobile_browser; // will return either true or false
            } else {
                return array($mobile_browser, $status); // is a mobile so we are returning an array ['0'] is true ['1'] is the $status value
            }
        }
    }
} // End class
