@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Edit')

{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit User</h3>
            </div>

            <form method="post" action="/user/update/{{ $user->user_id }}">
                @csrf
                @method('PUT') {{-- Method PUT untuk update data --}}

                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ old('username', $user->username) }}" placeholder="Masukkan username">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ old('nama', $user->nama) }}" placeholder="Masukkan nama user">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <select class="form-control" id="level_id" name="level_id">
                            <option value="">-- Pilih Level --</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->level_id }}"
                                    {{ old('level_id', $user->level_id) == $level->level_id ? 'selected' : '' }}>
                                    {{ $level->level_kode }} - {{ $level->level_nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Kosongi untuk tidak mengganti password">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/user" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
