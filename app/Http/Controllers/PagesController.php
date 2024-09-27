<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function home()
    {
        $data['header_title'] = "Home";
        return view('welcome', $data);
    }

}
