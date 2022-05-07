<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    //

    public function check_live_fb_uids()
    {
        return view('home.extensions.check_live_fb_uids');
    }

    public function authenticator()
    {
        return view('home.extensions.authenticator');
    }

}
