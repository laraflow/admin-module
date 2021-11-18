@extends('admin::layouts.master')

@section('title', $role->name ?? 'Details')

@push('meta')

@endpush

@push('webfont')

@endpush

@push('icon')

@endpush

@push('plugin-style')
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('modules/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
                            <p class="fw-bolder">{{ \Modules\Admin\Supports\Constant::ENABLED_OPTIONS[$role->enabled] ?? null }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <label class="d-block">Remarks</label>
                            <p class="fw-bolder">{{ $role->remarks ?? null }}</p>
                        </div>
                    </div>
                    <div class="row border-bottom my-3 d-flex justify-content-between">
                        <div class="mb-0 h3 align-middle">
                            <i class="mdi mdi-account-details-outline"></i>
                            Permissions
                        </div>
                        <button data-toggle="modal" data-target="#bd-example-modal-lg" class="btn btn-primary mb-2">
                            <i class="mdi mdi-account-convert-outline"></i>
                            <span class="d-none d-sm-inline-block">Add / Remove Permissions</span>
                        </button>
                    </div>
                    <div class="row mt-2">
                        @forelse($role->permissions as $permission)
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
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
    <!-- Permission Modal -->
    <div class="modal fade" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! \Form::open(['route' => ['admin.roles.permission', $role->id], 'method' => 'put']) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Available Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: scroll;">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="mdi mdi-magnify"></i>
                                            </span>
                                        </div>
                                        <input class="form-control"
                                               onkeyup="searchFilter(this.value, 'permission-table');"
                                               placeholder="Search Permission Name" id="search" type="search">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table table-hover table-sm mb-0" id="permission-table">
                                    <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="35" class="p-2 align-middle">
                                            <div class="icheck-primary">
                                                {!! Form::checkbox('permissions[]', $permission->id,
                                                    in_array($permission->id, $availablePermissionIds),
                                                     ['id' => 'permission_' . $permission->id, 'class' => 'permission-checkbox']) !!}
                                                <label for="{{ 'permission_' . $permission->id }}"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle">Permission</th>
                                        <th class="align-middle">Enabled</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($permissions as $permission)
                                        <tr class="@if($permission->enabled == \Modules\Admin\Supports\DefaultValue::ENABLED_OPTION) table-success @else table-danger @endif">
                                            <td class="p-2 text-center align-middle">
                                                <div class="icheck-primary">
                                                    {!! Form::checkbox('permissions[]', $permission->id,
                                                        in_array($permission->id, $availablePermissionIds),
                                                         ['id' => 'permission_' . $permission->id, 'class' => 'permission-checkbox']) !!}
                                                    <label for="{{ 'permission_' . $permission->id }}"></label>
                                                </div>
                                            </td>
                                            <td class="align-middle">{{ $permission->display_name }}</td>
                                            <td class="align-middle text-center">{{ \Modules\Admin\Supports\Constant::ENABLED_OPTIONS[$permission->enabled] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center font-weight-bolder">
                                                No Permission/Privileges Available
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                {!! \Form::close(); !!}
            </div>
        </div>
    </div>
@endsection

@push('component-scripts')

@endpush


@push('page-script')
    <script>
        function searchFilter(filter, targetTable) {
            filter = filter.toLowerCase();

            $("#" + targetTable).find("tbody tr").each(function () {
                var row = $(this);
                if (filter.length >= 1) {
                    var cellText = row.find("td").eq(1).text();
                    if (cellText.toLowerCase().indexOf(filter) < 0) {
                        row.hide();
                    }
                } else {
                    row.show();
                }
            });
        }
    </script>
@endpush
