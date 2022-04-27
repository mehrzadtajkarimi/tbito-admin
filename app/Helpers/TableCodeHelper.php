<?php

namespace App\Helpers;

class TableCodeHelper
{

    public static function id2Code($id)
    {
        return ($id + 2568) * 7;
    }

    public static function code2Id($code)
    {
        $code = (int) $code;
        $id = (($code / 7) - 2568);
        return (is_integer($id) && $id > 0) ? $id : 0;
    }
}
