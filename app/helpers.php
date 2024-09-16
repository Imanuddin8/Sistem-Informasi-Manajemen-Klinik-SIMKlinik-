<?php

use Carbon\Carbon;

if (!function_exists('formatDateTime')) {
    function formatDateTime($date, $format = 'd F Y H:i:s')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('formatDateOnly')) {  // Change function name to formatDateOnly
    function formatDateOnly($date, $format = 'd F Y')
    {
        return Carbon::parse($date)->format($format);
    }
}
