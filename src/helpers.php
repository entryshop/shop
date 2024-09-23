<?php

if (!function_exists('currency')) {
    function currency($value)
    {
        return Number::currency($value);
    }
}
