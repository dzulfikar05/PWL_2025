@extends('layouts.app')

@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat User Baru</h3>
            </div>

            <form method="post" action="../user">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama user">
                    </div>
                    <div class="form-group">
                        <label for="level_id">Level</label>
                        <select class="form-control" id="level_id" name="level_id">
                            <option value="">-- Pilih Level --</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->level_id }}">{{ $level->level_kode }} - {{ $level->level_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
