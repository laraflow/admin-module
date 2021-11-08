@extends('admin::layouts.master')

@section('title', $role->name ?? 'Details')

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

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName(), $role))


@section('actions')
    {!! \Html::backButton('admin.roles.index') !!}
    {!! \Html::editButton('admin.roles.edit', $role->id) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
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
                            <p class="fw-bolder">{{ \Modules\Core\Supports\Constant::ENABLED_OPTIONS[$role->enabled] ?? null }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <label class="d-block">Remarks</label>
                            <p class="fw-bolder">{{ $role->remarks ?? null }}</p>
                        </div>
                    </div>
                    <div class="row border-bottom">
                        <div class="card-title my-3">
                            <h4 class="mb-0">
                                <i class="mdi mdi-account-details-outline"></i>
                                Permissions
                            </h4>
                        </div>
                    </div>
                    <div class="row mt-2">
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
