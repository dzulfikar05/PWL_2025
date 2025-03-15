@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'User')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'User')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header">
                <div class="col-md-12 row">
                    <div class="col-6 d-flex justify-content-start">
                        <span>Manage User</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="/user/create" class="btn btn-primary">Add User</a>
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
