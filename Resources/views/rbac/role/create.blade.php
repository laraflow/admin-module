@extends('admin::layouts.master')

@section('title', 'Add Role')

@section('keywords', 'Register, sing up')

@section('description', 'user tries to login in to system')

@push('component-styles')

@endpush

@push('page-styles')

@endpush

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName()))

@section('options')
    {!! \Html::backButton('roles.index') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {!! Html::cardHeader('Add Role',
                        'mdi mdi-account-check-outline',
                         'DataTables has most features enabled by default.') !!}
                {!! \Form::open(['route' => 'roles.store', 'id' => 'role-form']) !!}
                @include('backend.preference.role.form')
                {!! \Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('component-scripts')

@endpush


@push('page-scripts')
@endpush
