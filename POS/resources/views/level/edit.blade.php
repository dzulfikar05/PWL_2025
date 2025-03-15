@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Edit')

{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Level</h3>
            </div>

            <form method="post" action="/level/update/{{ $level->level_id }}">
                @csrf
                @method('PUT') {{-- Method PUT untuk update data --}}

                <div class="card-body">
                    <div class="form-group">
                        <label for="level_nama">Level Nama</label>
                        <input type="text" class="form-control" id="level_nama" name="level_nama"
                            value="{{ old('level_nama', $level->level_nama) }}" placeholder="Masukkan level nama">
                    </div>
                    <div class="form-group">
                        <label for="level_kode">Level Kode</label>
                        <input type="text" class="form-control" id="level_kode" name="level_kode"
                            value="{{ old('level_kode', $level->level_kode) }}" placeholder="Masukkan level kode">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/level" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
