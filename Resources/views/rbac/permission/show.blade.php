@extends('admin::layouts.master')

@section('title', $permission->display_name)

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

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName(), $permission))

@section('actions')
    {!! \Html::backButton('admin.permissions.index') !!}
    {!! \Html::editButton('admin.permissions.edit', $permission->id) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body min-vh-100">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="d-block">Display Name</label>
                        <p class="fw-bolder">{{ $permission->display_name ?? null }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="d-block">Name</label>
                        <p class="fw-bolder">{{ $permission->name ?? null }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="d-block">Guard(s)</label>
                        <p class="fw-bolder">{{ $permission->guard_name ?? null }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="d-block">Enabled</label>
                        <p class="fw-bolder">{{ \Modules\Core\Supports\Constant::ENABLED_OPTIONS[$permission->enabled] }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="d-block">Remarks</label>
                        <p class="fw-bolder">{{ $permission->remarks ?? null }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

