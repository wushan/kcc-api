<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Session::get('login')==null)
            {
                return redirect('/');
            }else{
                return $next($request);
            }
        });
    }

    public function index()
    {
        return view('layout',['main'=>'admin']);
    }
}
