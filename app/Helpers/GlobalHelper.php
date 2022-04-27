<?php

namespace App\Helpers;

class GlobalHelper
{
    # slugify
    static public function slugify($str, $delimiter = '-')
    {
        $str = static::exchangeArabicChars($str);
        $str = mb_strtolower($str, 'UTF-8');
        $notAllowed = ['  ', ' ', '!', '@', '#', '$', '%', '&', '*', '(', ')', '+', ';', ':', "'", '"', '/', '\\', '?', '|', '؟', '،', ',', '-', '--'];
        $str = stripslashes($str);
        $str = trim($str);
        $str = str_replace($notAllowed, $delimiter, $str);
        $str = trim($str, $delimiter);
        return $str;
        /*
        $str = trim($str);
        $str = mb_ereg_replace('([^اآءأإئ-ی۰-۹a-zA-Z0-9]|-)+', $delimiter, $str);
        $str = trim($str, $delimiter);
        return $str;
        */
    }

    # exchangeArabicChars
    static function exchangeArabicChars($string)
    {
        $str = str_replace(['ك', 'ي'], ['ک', 'ی'], $string);
        $str = static::convertToEnglish($str);
        return $str;
    }

    # convertToEnglish
    static function convertToEnglish($string)
    {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array(
            '&#1776;',
            '&#1777;',
            '&#1778;',
            '&#1779;',
            '&#1780;',
            '&#1781;',
            '&#1782;',
            '&#1783;',
            '&#1784;',
            '&#1785;'
        );
        // 2. Arabic HTML decimal
        $arabicDecimal = array(
            '&#1632;',
            '&#1633;',
            '&#1634;',
            '&#1635;',
            '&#1636;',
            '&#1637;',
            '&#1638;',
            '&#1639;',
            '&#1640;',
            '&#1641;'
        );
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }

    # dirIsEmpty
    static public function dirIsEmpty($dir)
    {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                return false;
            }
        }
        return true;
    }

    # get default pic
    static public function getDefaultPic($pic)
    {
        $picSrc = "images/default/{$pic}";
        return $picSrc;
    } // getDefaultPic

    # sanitizeRequest
    static public function sanitizeRequest(array $inputs = [])
    {
        $requestArray = request()->all();
        if (!empty($inputs)) {
            $requestArray = request()->only($inputs);
        }
        foreach ($requestArray as $key => $val) {
            $val = static::exchangeArabicChars($val);
            $val = str_replace(',', '', $val);
            request()->merge([$key => $val]);
        }
    }

    static public function makeRandStr()
    {
        return md5(uniqid(mt_rand(), true).microtime(true));
    }
}
