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
    @canany(['admin.permissions.show', 'admin.permissions.edit', 'admin.permissions.destroy', 'admin.permissions.restore'])
        <div class="d-flex justify-content-center">
            <a id="actions1Invoker"
               class="link-muted bg-warning" href="#!"
               aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                <i class="fa fa-sliders-h"></i> Actions
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown"
                 style="width: 150px; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(898px, 169px, 0px);"
                 aria-labelledby="actions1Invoker" x-placement="bottom-end">
                <ul class="list-unstyled mb-0">
                    @if(Route::has('admin.permissions.edit'))
                        @can('admin.permissions.edit')
                            <li>
                                <a href="{{ route('admin.permissions.edit', $permission->id) }}" title="Show"
                                   class="d-flex align-items-center link-muted py-2 px-3">
                                    <i class="mdi mdi-square-edit fw-bold"></i> Edit
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(Route::has('admin.permissions.destroy'))
                        @can('admin.permissions.destroy')
                            <li>
                                <a href="{{ route('admin.common.delete', ['admin.permissions', $permission->id]) }}" title="Show"
                                   class="d-flex align-items-center link-muted py-2 px-3 delete-btn">
                                    <i class="mdi mdi-close-thick fw-bold mr-1"></i> Delete
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(Route::has('admin.permissions.restore'))
                        @can('admin.permissions.restore')
                            <li>
                                <a href="{{ route('admin.permissions.restore', $permission->id) }}" title="Show"
                                   class="d-flex align-items-center link-muted py-2 px-3">
                                    <i class="mdi mdi-delete-restore fw-bold mr-1"></i> Restore
                                </a>
                            </li>
                        @endcan
                    @endif
                </ul>
            </div>
        </div>
    @endcanany
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
                        <p class="fw-bolder">{{ \Modules\Admin\Supports\Constant::ENABLED_OPTIONS[$permission->enabled] }}</p>
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

