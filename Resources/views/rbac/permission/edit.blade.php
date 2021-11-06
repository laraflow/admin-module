@extends('admin::layouts.master')

@section('title', 'Edit Permission')

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

@section('breadcrumbs', \Breadcrumbs::render(Route::getCurrentRoute()->getName(), $permission))

@section('actions')
    {!! \Html::backButton('permissions.index') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {!! \Form::open(['route' => ['permissions.update', $permission->id], 'method' => 'put', 'id' => 'permission-form']) !!}
                @include('admin::rbac.permission.form')
                {!! \Form::close() !!}
            </div>
        </div>
    </div>
    @endsection


    @push('plugin-script')

    @endpush

    @push('page-script')

    @endpush
