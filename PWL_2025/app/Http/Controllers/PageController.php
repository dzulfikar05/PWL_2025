<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return "Selamat Datang";
    }

    public function about()
    {
        return "Nama: Dzulfikar Muhammad Al Ghifari <br> NIM: 2304170071";
    }

    public function articles($id)
    {
        return "Halaman Artikel dengan Id " . $id;
    }
}
