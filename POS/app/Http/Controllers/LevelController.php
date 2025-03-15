<?php

namespace App\Http\Controllers;

use App\DataTables\LevelDataTable;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LevelController extends Controller
{

    public function index(LevelDataTable $dataTable)
    {
        return $dataTable->render('level.index');
    }

    public function create()
    {
        $levels = LevelModel::all();
        return view('level.create', compact('levels'));
    }

    public function store(Request $request)
    {
        LevelModel::create([
            'level_nama' => $request->level_nama,
            'level_kode' => $request->level_kode,
        ]);
        return redirect('/level');
    }

    public function edit($id)
    {
        $level = LevelModel::find($id);
        $levels = LevelModel::all();
        return view('level.edit', compact('level', 'levels'));
    }

    public function update(Request $request, $id)
    {
        $level = LevelModel::find($id);
        $level->level_nama = $request->level_nama;
        $level->level_kode = $request->level_kode;
        $level->save();
        return redirect('/level');
    }

    public function destroy($id)
    {
        $level = LevelModel::find($id);
        $level->delete();
        return redirect('/level');
    }
}
