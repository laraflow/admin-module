@extends('admin::layouts.master')

@section('title', 'Edit User')

@section('keywords', 'Register, sing up')

@section('description', 'user tries to login in to system')

@push('component-styles')

@endpush

@push('page-styles')

@endpush

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName(), $user))

@section('actions')
    {!! \Html::backButton('admin.users.index') !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            {!! \Form::open(['route' => ['admin.users.update', $user->id], 'files' => true, 'id' => 'user-form', 'method' => 'put']) !!}
            @include('admin::rbac.user.form')
            {!! \Form::close() !!}
        </div>
    </div>
@endsection

@push('component-script')

@endpush


@push('page-script')

@endpush
