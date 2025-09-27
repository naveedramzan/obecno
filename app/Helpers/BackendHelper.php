<?php
namespace App\Helpers;

class BackendHelper
{
    public static function toSlug(string $string)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($string)));
    }

}
?>