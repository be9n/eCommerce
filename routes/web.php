<?php

use Illuminate\Support\Facades\Route;

Route::get('test', function (){
   $method = \App\Models\Setting::find(13);
   return $method -> translations;
});
