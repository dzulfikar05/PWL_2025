<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\KategoriRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KategoriController extends Controller
{

    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    public function create()
    {

        return view('kategori.create');
    }

    public function store(KategoriRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        KategoriModel::create($validated);
        return redirect('/kategori')->withErrors($validated);
    }

    public function edit($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(KategoriRequest $request, $id)
    {
        $validated = $request->validated();
        $kategori = KategoriModel::find($id);
        $kategori->kategori_kode = $validated['kategori_kode'];
        $kategori->kategori_nama = $validated['kategori_nama'];
        $kategori->save();
        return redirect('/kategori');
    }

    public function destroy($id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->delete();
        return redirect('/kategori');
    }
}
