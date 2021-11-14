@extends('admin::layouts.master')

@section('title', 'Add Role')

@push('meta')

@endpush

@push('webfont')

@endpush

@push('icon')

@endpush

@push('plugin-style')

@endpush

@push('inline-style')

@endpush

@push('head-script')

@endpush

@section('body-class', 'sidebar-mini')

@section('breadcrumbs', \Breadcrumbs::render(Route::getCurrentRoute()->getName()))

@section('actions')
    {!! \Html::backButton('admin.roles.index') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {!! \Form::open(['route' => 'admin.roles.store', 'id' => 'role-form']) !!}
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
