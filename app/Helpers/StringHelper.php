<?php

namespace App\Helpers;

class StringHelper
{
    // Helper class methods go here...
    function limitString($string, $limit)
    {
        if (strlen($string) > $limit) {
            $string = substr($string, 0, $limit) . "...";
        }
        return $string;
    }
}