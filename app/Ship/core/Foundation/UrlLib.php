<?php
/**
 * Created by PhpStorm.
 * Filename: UrlLib.php
 * User: Oops!Memory
 * Date: 8/20/20
 * Time: 15:34
 */

namespace Apiato\Core\Foundation;

use Illuminate\Support\Str;

class UrlLib
{
    public static function isUrl($url = '')
    {
        return !(filter_var($url, FILTER_VALIDATE_URL) === FALSE);
    }

    static function extract_domain($domain)
    {
        if (preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $domain, $matches)) {
            return $matches['domain'];
        } else {
            return $domain;
        }
    }

    static function extract_subdomains($domain)
    {
        $subdomains = $domain;
        $domain = self::extract_domain($subdomains);

        $subdomains = rtrim(strstr($subdomains, $domain, true), '.');

        return $subdomains;
    }

    static function getHost()
    {
        $urls = parse_url(request()->url());
        return @$urls['host'] ?? '';
    }

    public static function convertToLocale($link = '')
    {
        if ($link && !self::isUrl($link)) {
            $defLang = Lib::getDefaultLang();

            $link = Str::contains($link, ['/' . $defLang . '/', $defLang . '/']) ? $link : (Str::startsWith($link, '/') ? '/' . $defLang . $link : '/' . $defLang . '/' . $link);
        }

        return $link;
    }

    public static function getChangeLangUrl($lang = 'vi', $currentLang)
    {
        if (config('apiato.using_locale_segment')) {
            return route('web.home.index_no_lang') . '/' . $lang;
            //request()->route()->getPrefix()
            //return str_replace('/' . $currentLang . '/', '/' . $lang . '/', url()->full());
        } else {
            return route('web.home.index_no_lang');
        }
    }
}