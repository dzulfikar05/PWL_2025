<?php

namespace App\Http\Controllers; // define bahwa file ini terletak di folder app/Http\Controllers

use App\Models\Item; // Import mdel Item
use Illuminate\Http\Request; // Import Request

class ItemController extends Controller // Class ItemController mewarisi Controller
{
    public function index() // Method index
    {
        $items = Item::all(); // Mengambil semua item dari db
        return view('items.index', compact('items')); // mengembalikan view index dari folder item, kemudian mengirimkan data $item pada view
    }

    public function create() // Method create
    {
        return view('items.create'); // Mengembalikan view create
    }

    public function store(Request $request) // Method store dengan parameter request
    {
        $request->validate([ // Validasi request dari form
            'name' => 'required',
            'description' => 'required',
        ]);

        //Item::create($request->all());
        //return redirect()->route('items.index');

        // Hanya masukkan atribut yang diizinkan
         Item::create($request->only(['name', 'description']));
        return redirect()->route('items.index')->with('success', 'Item added successfully.'); // Mengembalikan pada route items.index dan menambahkan pesan sukses
    }

    public function show(Item $item)  // Method show dengan parameter dari model item
    {
        return view('items.show', compact('item')); // mengembalikan  view dari item.show dan mengirimkan data $item
    }

    public function edit(Item $item) // method edit dengan parameter dari model item
    {
        return view('items.edit', compact('item')); // mengembalikan  view dari item.edit dan mengirimkan data $item
    }

    public function update(Request $request, Item $item)  // method update dengan paraeter request dan model item
    {
        $request->validate([ // Validasi request dari form
            'name' => 'required',
            'description' => 'required',
        ]);

        //$item->update($request->all());
        //return redirect()->route('items.index');
        // Hanya masukkan atribut yang diizinkan
         $item->update($request->only(['name', 'description']));
        return redirect()->route('items.index')->with('success', 'Item updated successfully.'); // Mengembalikan pada route items.index dan menambahkan pesan sukses
    }

    public function destroy(Item $item)
    {

       // return redirect()->route('items.index');
       $item->delete(); // Menghapus item
       return redirect()->route('items.index')->with('success', 'Item deleted successfully.'); // Mengembalikan pada route items.index dan menambahkan pesan sukses
    }
}
