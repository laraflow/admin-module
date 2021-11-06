@extends('admin::layouts.master')

@section('title', $role->name)

@section('keywords', 'Register, sing up')

@section('description', 'user tries to login in to system')

@push('component-styles')

@endpush

@push('page-styles')

@endpush

@section('breadcrumbs', \Breadcrumbs::render(\Route::getCurrentRoute()->getName(), $role))

@section('options')
    {!! \Html::backButton('roles.index') !!}
    {!! \Html::editButton('roles.edit', $role->id) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {!! Html::cardHeader('Role Details',
                        'mdi mdi-account-check-outline',
                         'DataTables has most features enabled by default.') !!}
                <div class="card-body min-vh-100">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="d-block">Name</label>
                            <p class="fw-bolder">{{ $role->name ?? null }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="d-block">Guard(s)</label>
                            <p class="fw-bolder">{{ $role->guard_name ?? null }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="d-block">Enabled</label>
                            <p class="fw-bolder">{{ \Constant::ENABLED_OPTIONS[$role->enabled] ?? null }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <label class="d-block">Remarks</label>
                            <p class="fw-bolder">{{ $role->remarks ?? null }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="border-bottom my-3">
                            <div class="card-title d-flex justify-content-between">
                                <h4 class="mb-0">
                                    <i class="mdi mdi-account-details-outline"></i>
                                    Permissions
                                </h4>
                            </div>
                            <p class="card-title-desc mb-3">
                                Permission /Privilege assigned to this Role.
                            </p>
                        </div>
                        @forelse($role->permissions as $permission)
                            <div class="col-md-3">
                                <p class="text-dark fw-bold" title="{{ $permission->name }}">
                                    <i class="mdi mdi-account-key m-2"></i> {{ $permission->display_name }}
                                </p>
                            </div>
                        @empty
                            <div class="col-12 text-center fw-bolder">This Role Don't have any Permission/Privileges
                            </div>
                        @endforelse
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
