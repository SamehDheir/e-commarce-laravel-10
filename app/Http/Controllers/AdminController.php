<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\password;

class AdminController extends Controller
{
    public function loginHandler(Request $request)
    {
        $feldtype = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($feldtype == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:admins,email',
                'password' => 'required|min:5|max:10',
            ], [
                'login_id.required' => 'Email Or Username is required',
                'login_id.email' => 'Email  is required',
                'login_id.exists' => 'Email is not exists in system',
                'password.required' => 'Password is required',
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:admins,username',
                'password' => 'required|min:5|max:10',
            ], [
                'login_id.required' => 'Email Or Username is required',
                'login_id.username' => 'Username  is required',
                'password.required' => 'Password is required',
            ]);
        }

        //cheak email/username and password in table admins

        $creds = array(
            $feldtype => $request->login_id,
            'password' => $request->password,
        );
        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('admin.home');
        } else {
            session()->flash('fail', 'Incrrect Credeantails');
            return redirect()->route('admin.login');
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        session()->flash('fail', 'You are logg ed out !!');
        return redirect()->route('admin.login');
    }
}
