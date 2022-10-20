<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {
        $shippingMethod = Setting::find($id);
        DB::beginTransaction();
        $shippingMethod -> update(['plain_value' => $request -> plain_value,]);
        //save translation
        $shippingMethod -> value = $request -> value;
        $shippingMethod -> save();

        DB::commit();
        return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);
        }catch (\Exception $ex){
            return redirect() -> back() -> with(['error' => 'حدث خطأ ما!']);
            DB::rollBack();
        }
    }
}
