@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kagegori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="col-md-12 row">
                    <div class="col-6 d-flex justify-content-start">
                        <span>Manage Kategori</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="/kategori/create" class="btn btn-primary">Add Kategori</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
