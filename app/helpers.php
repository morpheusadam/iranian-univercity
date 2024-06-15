<?php

use Illuminate\Support\Facades\Route;

function in_route($route)
{
    if (is_array($route))
        foreach ($route as $r)
            if (Route::is($r))
                return true;
    return Route::is($route);
}

function toPersianDigits($string)
{
    $string = str_replace("1", "۱", $string);
    $string = str_replace("2", "۲", $string);
    $string = str_replace("3", "۳", $string);
    $string = str_replace("4", "۴", $string);
    $string = str_replace("5", "۵", $string);
    $string = str_replace("6", "۶", $string);
    $string = str_replace("7", "۷", $string);
    $string = str_replace("8", "۸", $string);
    $string = str_replace("9", "۹", $string);
    $string = str_replace("0", "۰", $string);
    return $string;
}
