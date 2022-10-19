<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{


    public function editShippingMethods($type)
    {

        if ($type === 'free') {
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();
        } elseif ($type === 'local') {
            $shippingMethod = Setting::where('key', 'local_shipping_label')->first();
        } elseif ($type === 'global') {
            $shippingMethod = Setting::where('key', 'global_shipping_label')->first();

        }else{
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();
        }
        return view('admin.settings.shipping.edit', compact('shippingMethod'));
    }

    public function updateShippingMethods(ShippingRequest $request, $id){

    }
}
