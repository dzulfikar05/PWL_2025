<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function foodBeverage()
    {
        $products = [
            ['name' => 'Kopi', 'price' => 15000],
            ['name' => 'Teh', 'price' => 12000],
            ['name' => 'Susu', 'price' => 18000]
        ];
        $label = 'Food and Beverage';
        return view('products.show', compact('products', 'label'));
    }

    public function beautyHealth()
    {
        $products = [
            ['name' => 'Shampoo', 'price' => 35000],
            ['name' => 'Sabun Mandi', 'price' => 25000],
            ['name' => 'Pelembab', 'price' => 50000]
        ];

        $label = 'Beauty and Health';
        return view('products.show', compact('products', 'label'));
    }

    public function homeCare()
    {
        $products = [
            ['name' => 'Deterjen', 'price' => 30000],
            ['name' => 'Pembersih Lantai', 'price' => 28000],
            ['name' => 'Pengharum Ruangan', 'price' => 20000]
        ];

        $label = 'Home Care';
        return view('products.show', compact('products', 'label'));
    }

    public function babyKid()
    {
        $products = [
            ['name' => 'Popok Bayi', 'price' => 45000],
            ['name' => 'Susu Formula', 'price' => 85000],
            ['name' => 'Mainan Anak', 'price' => 60000]
        ];

        $label = 'Baby and Kid';
        return view('products.show', compact('products', 'label'));
    }
}
