<?php

if (!function_exists('in_request_array')) {
    function in_request_array($needle, $haystack = '*')
    {
        if (is_array($needle))
        {
            foreach ($needle as $item)
                if (in_array($item, request()->input($haystack) ?? []))
                    return true;
            return false;
        }
        return in_array($needle, request()->input($haystack) ?? []);
    }
}

if (!function_exists('cart')) {
    function cart()
    {
        return new \App\Helpers\Cart\CartService;
    }
}

if (!function_exists('setting')) {
    function setting($name)
    {
        return \App\Models\Setting::find($name)->value;
    }
}

if (!function_exists('is_active_hours')) {
    function is_active_hours(): bool
    {
        if (\Morilog\Jalali\Jalalian::now()->lessThan(\Morilog\Jalali\Jalalian::forge(setting('start_time'))))
            return false;

        if (\Morilog\Jalali\Jalalian::now()->greaterThan(\Morilog\Jalali\Jalalian::forge(setting('end_time'))))
            return false;

        return true;
    }
}


if (!function_exists('convert_persian_numbers')) {
    function convert_persian_numbers($number)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $number);
        return str_replace($arabic, $num, $convertedPersianNums);
    }
}
