<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function editProfile(){
        $id = auth('admin') -> user() -> id;
        $admin = Admin::find($id);
        return view('admin.profile.profileEdit', compact('admin'));
    }

    public function updateProfile(AdminProfileRequest $request){

            //$admin = Admin::find($request -> id);

            $admin =Admin::find(auth('admin')->user()->id);

            if ($request -> filled('password')){
                $request -> merge(['password' => bcrypt($request -> password)]);
            }

           // $request -> request -> remove('id');
            unset($request['id'], $request['password_confirmation']);
           // $admin -> update($request -> only(['name', 'email']));
            $admin -> update($request -> all());
            return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);

    }

}
