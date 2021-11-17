@extends('layouts.app')

@section('title', 'Users')

@section('keywords', 'Register, sing up')

@section('description', 'user tries to login in to system')

@push('component-styles')

@endpush

@push('page-styles')

@endpush

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName()))

@section('options')
    <a href="{{ route('layouts.create') }}" class="btn btn-success"><i class="mdi mdi-plus fw-bold"></i><span class="d-none d-sm-inline-flex">Add Layout</span></a>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="p-4" style="height: 300px;">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('component-scripts')

@endpush


@push('page-scripts')

@endpush
