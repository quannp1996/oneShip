<?php

namespace Apiato\Core\Foundation;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Throwable;

class ImageURL
{
    const DEFAULT_DIR = 'upload';
    const DEFAULT_DIR_ORIGINAL = 'original';
    const DEFAULT_DIR_THUMB = 'thumb';
    const DEFAULT_NO_IMAGE = 'no_photo.jpg';
    const QUALITY = 100;
    public static $data = [];

    public static function getImageUrl($file_name, $key, $sizeName, $check = false)
    {
        $dir = self::getDir($key);
        $size = self::getSize($key, $sizeName);
        $width = $size['width'];
        $height = $size['height'];
        $path = self::DEFAULT_DIR . '/' . self::DEFAULT_NO_IMAGE;

        $ext = @pathinfo($file_name)['extension'];

        if ($check) {
            dd($ext);
        }

        if ($ext != 'svg' && $file_name != '') {
            if ($width == 0 && $height == 0) {
                $path = $dir . '/' . self::DEFAULT_DIR_ORIGINAL . '/' . $file_name;
            } else {
                $path = $dir . '/' . self::DEFAULT_DIR_THUMB . '_' . $width . 'x' . $height . '/' . $file_name;
            }
        } elseif ($ext == 'svg') {
            $path = $dir . '/' . self::DEFAULT_DIR_ORIGINAL . '/' . $file_name;
        }

        /*$env = env('APP_ENV', 'local');
        if ($env == 'local' || $env == 'product-dev') {
            return config('app.url') . '/' . $path;
        }*/

        return asset($path);
    }

    public static function upload($image, $filename, $key, &$err = '')
    {
        $dir = self::getDir($key);
        $dir .= '/' . self::DEFAULT_DIR_ORIGINAL;

        //create dir if not existed
        if (!\File::exists($dir)) {
            \File::makeDirectory($dir, 0755, true);
        }

        if ($image->getClientOriginalExtension() != 'svg') {
            //create image from source
            $image = \Image::make($image);

            return $image->save($dir . '/' . $filename, self::QUALITY);
        } else {

            // try {
                return $image->move($dir, $filename);
            // } catch (Throwable $e) {
            //     throw $e;
            //     return true;
            // }
            // \File::copy($dir . '/' . $filename, $dir . '/thumbs/thm_' . $filename);
        }
    }

    public static function autoGenImageFromURL($path = '')
    {
        if (!empty($path)) {
            $path = explode('/', $path);
            $filename = array_pop($path);
            $thumb_str = array_pop($path);
            $key = array_pop($path);

            //process thumb_str
            $thumb_str = str_replace(self::DEFAULT_DIR_THUMB . '_', '', $thumb_str);
            $thumb_str = explode('x', $thumb_str);

            $sizeName = self::getSizeName($key, $thumb_str[0], $thumb_str[1]);
            if (!empty($sizeName)) {
                $ret = self::thumb($filename, $key, $sizeName);
                if ($ret) {
                    return $ret;
                }
            }
        }
        return \Image::make(self::DEFAULT_DIR . '/' . self::DEFAULT_NO_IMAGE)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
    }

    public static function makeFileName($fname, $tail)
    {
        return substr(Str::slug($fname), 0, 100) . '-' . time() . "." . $tail;
        //        return str_replace('-', '_', $fname) . '_' . time() . "." . $tail;
    }

    protected static function thumb($filename, $key, $sizeName)
    {
        $dir = self::getDir($key);
        $original = $dir . '/' . self::DEFAULT_DIR_ORIGINAL . '/' . urldecode($filename);
        if (!\File::exists($original)) {
            return false;
        }

        $size = self::getSize($key, $sizeName);
        $width = $size['width'];
        $height = $size['height'];

        $path = $dir . '/' . self::DEFAULT_DIR_THUMB . '_' . $width . 'x' . $height;
        //create dir if not existed
        if (!\File::exists($path)) {
            \File::makeDirectory($path, 0755, true);
        }

        $filename = $path . '/' . $filename;
        //create image from original
        $image = \Image::make($original);
        return $image
            ->resize($width > 0 ? $width : null, $height > 0 ? $height : null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($filename, self::QUALITY);
    }

    public static function getDir($key)
    {
        self::getConfig();
        $dir = self::DEFAULT_DIR;
        if (isset(self::$data[$key]['dir'])) {
            $dir .= '/' . self::$data[$key]['dir'];
        }
        return $dir;
    }

    protected static function getSize($key, $sizeName)
    {
        self::getConfig();
        if (isset(self::$data[$key]) && isset(self::$data[$key]['size'][$sizeName])) {
            return self::$data[$key]['size'][$sizeName];
        }
        return ['width' => 0, 'height' => 0];
    }

    protected static function getSizeName($key, $with = 0, $height = 0)
    {
        self::getConfig();
        if (isset(self::$data[$key])) {
            foreach (self::$data[$key]['size'] as $k => $size) {
                if ($size['width'] == $with && $size['height'] == $height) {
                    return $k;
                }
            }
        }
        return '';
    }

    protected static function maxSize($key)
    {
        self::getConfig();
        if (isset(self::$data[$key])) {
            return self::$data[$key]['max'];
        }
        return [];
    }
    static function getConfig()
    {
        if (empty(self::$data)) {
            $default = config('image.defaultImg');
            self::$data = config('image.data');
            foreach (self::$data as $k => $v) {
                self::$data[$k]['dir'] = $k;
                foreach ($default as $kd => $vd) {
                    if (!isset(self::$data[$k][$kd])) {
                        self::$data[$k][$kd] = $vd;
                    }
                }
                foreach ($v as $kk => $vv) {
                    if (isset($default[$kk])) {
                        self::$data[$k][$kk] = array_merge($default[$kk], self::$data[$k][$kk]);
                    }
                }
            }
        }
    }

    static function checkTypeFile($path)
    {
        $mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path);
        switch (strtolower($mime)) {
            case 'image/png':
            case 'image/x-png':
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'image/gif':
            case 'image/webp':
            case 'image/svg':
            case 'image/svg+xml':
                return true;
            case 'image/x-webp':
                if (!function_exists('imagecreatefromwebp')) {
                    return false;
                }
                break;

            default:
                return false;
                break;
        }
    }
}
