@extends('admin::layouts.master')

@section('title', 'Add User')

@section('keywords', 'Register, sing up')

@section('description', 'user tries to login in to system')

@push('component-styles')

@endpush

@push('page-styles')

@endpush

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName()))

@section('actions')
    {!! \Html::backButton('admin.users.index') !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            {!! \Form::open(['route' => 'admin.users.store', 'files' => true, 'id' => 'user-form']) !!}
            @include('admin::rbac.user.form')
            {!! \Form::close() !!}
        </div>
    </div>
@endsection

@push('component-scripts')

@endpush


@push('page-scripts')

@endpush
