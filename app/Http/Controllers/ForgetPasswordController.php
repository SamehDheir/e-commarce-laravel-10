<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Str;
use Mail;


class ForgetPasswordController extends Controller
{

    public function forgetPassword(Request $request)
    {
        return view('back.pages.admin.auth.forget-password');
    }

    ///////

    public function forgetPasswordPost(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if (!empty($admin)) {
            $admin->token = Str::random(40);
            $admin->save();
            FacadesMail::to($admin->email)->send(new ForgetPasswordMail($admin));
            return view('back.pages.admin.mail.verifyEmail', compact('admin'));
        } elseif (empty($request->email)) {
            session()->flash('fail', 'Please, Enter Email');
            return redirect()->back();
        } else {
            session()->flash('fail', 'Please, Enter  Exists Email');
            return redirect()->back();
        }
    }

    ///////


    public function restPasswordPage(Request $request)
    {
        return view('back.pages.admin.mail.restPassword');
    }

    /////////

    public function forgetPasswordReset(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if (!empty($request->email)) {
            if ($request->password == $request->confirm_password) {
                $admin->password = Hash::make($request->password);
                $admin->save();
                session()->flash('success', 'The password has been changed successfully');
                return redirect()->route('admin.login');
            } else {
                session()->flash('fail', 'The passwords are not the same');
                return redirect()->back();
            }
        } else {
            session()->flash('fail', 'Email Not Exites');
            return redirect()->back();
        }
    }
}
