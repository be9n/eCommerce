Helper: <?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


function locales()
{
    $arr = [];
    foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
        $arr[$key] = __('translate.' . $key);
    }
    return $arr;
}
