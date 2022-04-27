<?php
namespace App\Helpers;

use Carbon\Carbon;

class DateTimeHelper
{

    public static function getDate($timestamp=null, $format="Y/m/d")
    {
        $timestamp = (!empty($timestamp)) ? $timestamp : time() ;
        if (app()->isLocale("fa")) {
            return GlobalHelper::convertToEnglish(JDateHelper::jdate($format, $timestamp));
        } else {
            return Carbon::createFromTimestamp($timestamp)->format($format);
        }
    }

    public static function getTime($timestamp=null, $format="H:i")
    {
        $timestamp = (!empty($timestamp)) ? $timestamp : time() ;
        if (app()->isLocale("fa")) {
            return GlobalHelper::convertToEnglish(JDateHelper::jdate($format, $timestamp));
        } else {
            return Carbon::createFromTimestamp($timestamp)->format($format);
        }
    }

    public static function getDateTime($timestamp=null, $format="Y/m/d H:i")
    {
        $timestamp = (!empty($timestamp)) ? $timestamp : time() ;
        if (app()->isLocale("fa")) {
            return GlobalHelper::convertToEnglish(JDateHelper::jdate($format, $timestamp));
        } else {
            return Carbon::createFromTimestamp($timestamp)->format($format);
        }
    }

    
}
