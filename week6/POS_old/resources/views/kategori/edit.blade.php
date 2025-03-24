@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Edit')

{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Kategori</h3>
            </div>

            <form method="post" action="/kategori/update/{{ $kategori->kategori_id }}">
                @csrf
                @method('PUT') {{-- Method PUT untuk update data --}}

                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Kode Kategori</label>
                        <input type="text" class="form-control @error('kategori_kode') is-invalid @enderror"
                               id="kodeKategori" name="kategori_kode"
                               value="{{ old('kategori_kode', $kategori->kategori_kode) }}" placeholder="Masukkan kode kategori">
                        @error('kategori_kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="namaKategori">Nama Kategori</label>
                        <input type="text" class="form-control @error('kategori_nama') is-invalid @enderror"
                               id="namaKategori" name="kategori_nama"
                               value="{{ old('kategori_nama', $kategori->kategori_nama) }}" placeholder="Masukkan nama kategori">
                        @error('kategori_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/kategori" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
