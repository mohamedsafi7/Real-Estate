<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        app()->setLocale('fr');
        dd(__('messages.welcome'), __('messages.login'));
        return view('test');
    }
}
