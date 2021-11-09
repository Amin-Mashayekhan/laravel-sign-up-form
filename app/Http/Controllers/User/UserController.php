<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SignUpRequest;
use App\Lib\File\FileUploader;
use App\Lib\CommonHelpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function signUpShow(Request $request)
    {
        if ($request->introducer_id) {
            if (User::find($request->introducer_id)) {
                Session::put('introducer_id', $request->introducer_id);
            } else{
                CommonHelpers::newFeedback('', 'لینک معرف معتبر نمی باشد', 'error');
            }
        } elseif(Session::get('introducer_id')){
            Session::flash('introducer_id', null);
        }
        return view('User.sign-up');
    }

    
    public function signUpStore(SignUpRequest $request) 
    {
        $image = null;
        if ($request->user_image) {
            if (is_object($request->user_image)) {
                $image = FileUploader::move($request->user_image, 'User/Image/');
            } else {
                CommonHelpers::newFeedback('', 'فایل ارسال شده معتبر نمی باشد.', 'error');
                return back();
            }
        } 
        $result = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'user_image' => $image,
            'age' => $request->age,
            'introducer_id' => $request->introducer_id,
            'password' => Hash::make($request->password),
        ]); 
        if ($result) {
            CommonHelpers::newFeedback();
        } else{
            CommonHelpers::newFeedback('', 'مشکلی پیش آمده است.','error');
        }
        return back();
    }
}
