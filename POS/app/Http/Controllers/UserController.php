<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function create()
    {
        $levels = LevelModel::all();
        return view('user.create', compact('levels'));
    }

    public function store(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'level_id' => $request->level_id,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/user');
    }

    public function edit($id)
    {
        $user = UserModel::find($id);
        $levels = LevelModel::all();
        return view('user.edit', compact('user', 'levels'));
    }

    public function update(Request $request, $id)
    {
        $user = UserModel::find($id);
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->level_id = $request->level_id;
        if($request->password == null || $request->password == "") {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/user');
    }

    public function destroy($id)
    {
        $user = UserModel::find($id);
        $user->delete();
        return redirect('/user');
    }
}
