<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LoginController
{
    public function login(Request $request)
    {
        $adminData = App::make('App\AdminModel')->getAdmin();
        $loginData = $request->all();
        if ($loginData['account'] != $adminData->account || $loginData['password'] != $adminData->password) {
            return redirect('errors');
        }else{
            Session::put('login', 1);
        }

        return redirect('admin');
    }

    public function logout()
    {
        Session::flush();

        return redirect('admin');
    }
}
