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
    public function signUpShow($introducer_id = null)
    {
        dd($introducer_id, 'hi');
        if ($introducer_id) {
            if (User::find($introducer_id)) {
                Session::put('introducer_id', $introducer_id);
            } else{
                CommonHelpers::newFeedback('', 'لینک معرف معتبر نمی باشد', 'error');
                if (Session::has('introducer_id')) {
                    Session::forget('introducer_id');
                }
            }
        } elseif (Session::has('introducer_id')) {
            Session::forget('introducer_id');
        }
        $users = User::select('id', 'introducer_id', 'created_at')->get();
        return view('User.sign-up', compact('users'));
    }

    
    public function signUpStore(SignUpRequest $request) 
    {
        $image = null;
        if ($request->user_image) {
            if (is_object($request->user_image)) {
                $image = FileUploader::move($request->user_image, 'User/Image');
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
