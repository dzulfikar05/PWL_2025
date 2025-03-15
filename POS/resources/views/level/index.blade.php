@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Level')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Level')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header">
                <div class="col-md-12 row">
                    <div class="col-6 d-flex justify-content-start">
                        <span>Manage Level</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="/level/create" class="btn btn-primary">Add Level</a>
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
