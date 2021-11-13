@extends('admin::layouts.master')

@section('title', 'Add Role')

@section('keywords', 'Register, sing up')

@section('description', 'user tries to login in to system')

@push('component-styles')

@endpush

@push('page-styles')

@endpush

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName(), $role))

@section('actions')
    {!! \Html::backButton('admin.users.index') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {!! \Form::open(['route' => ['admin.users.update', $role->id], 'method' => 'put', 'id' => 'role-form']) !!}
               @include('admin::rbac.role.form')
                {!! \Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('component-scripts')

@endpush


@push('page-scripts')
@endpush
