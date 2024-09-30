<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function home()
    {
        $data['header_title'] = "Inicio";
        return view('welcome', $data);
    }
    public function myOrders()
    {
        $data['header_title'] = "Meus pedidos";
        return view('myOrders', $data);
    }
    public function login()
    {
        $data['header_title'] = "Inicio";
        return view('login', $data);
    }
    public function orders()
    {
        $data['header_title'] = "Pedidos";
        return view('orders', $data);
    }

}
