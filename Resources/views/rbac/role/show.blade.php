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
    @can('admin.roles.permission')
        <a href="#!" data-toggle="modal" data-target="#bd-example-modal-lg"
                class="btn btn-primary m-1 m-md-0">
            <i class="mdi mdi-account-convert-outline"></i>
            <span class="d-none d-md-inline-flex">Add / Remove Permissions</span>
        </a>
    @endcan

    {!! \Html::modelDropdown('admin.roles', $role->id, ['color' => 'success',
        'actions' => array_merge(['edit'], ($role->deleted_at == null) ? ['delete'] : ['restore'])]) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header p-3">
                        <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab"
                                   data-toggle="pill" href="#pills-home" role="tab"
                                   aria-controls="pills-home" aria-selected="true"><strong>Details</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-permission-tab"
                                   data-toggle="pill" href="#pills-permission" role="tab"
                                   aria-controls="pills-permission"
                                   aria-selected="true"><strong>Permissions</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-timeline-tab"
                                   data-toggle="pill" href="#pills-timeline"
                                   role="tab" aria-controls="pills-timeline"
                                   aria-selected="false"><strong>Timeline</strong></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body min-vh-100">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                 aria-labelledby="pills-home-tab">
                                <div class="row mb-3">
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
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label class="d-block">Remarks</label>
                                        <p class="fw-bolder">{{ $role->remarks ?? null }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-permission" role="tabpanel"
                                 aria-labelledby="pills-permission-tab">
                                <div class="row border-bottom my-3 d-flex justify-content-between">
                                    <div class="mb-0 h3 align-middle">
                                        <i class="mdi mdi-account-details-outline"></i>
                                        Permissions
                                    </div>
                                </div>
                                <div class="row">
                                    @forelse($role->permissions as $permission)
                                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                                            <p class="text-dark fw-bold" title="{{ $permission->name }}">
                                                <i class="mdi mdi-account-key m-2"></i> {{ $permission->display_name }}
                                            </p>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center fw-bolder">This Role Don't have any
                                            Permission/Privileges
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-timeline" role="tabpanel"
                                 aria-labelledby="pills-timeline-tab">
                                @include('admin::layouts.partials.timeline', $timeline)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="bd-example-modal-lg" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    {!! \Form::open(['route' => ['admin.roles.permission', $role->id], 'method' => 'put', 'id' => 'role-permission-form']) !!}
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
                                                    {!! Form::checkbox('test', 1,false, ['id' => 'permission_all']) !!}
                                                    <label for="permission_all"></label>
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
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    {!! \Form::close(); !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script>
        $(function () {
            $("#permission_all").click(function () {
                if ($(this).prop("checked")) {
                    $(".permission-checkbox").each(function () {
                        $(this).prop("checked", true);
                    });
                } else {
                    $(".permission-checkbox").each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });

            $("#role-permission-form").submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                var formUrl = $(this).attr('action');

                $.ajax({
                    url: formUrl,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    dateType: "JSON",
                    success: function (response) {
                        if (response.status === true) {
                            notify(response.message, response.level, response.title);
                            setTimeout(function () {
                                window.location.reload();
                            }, 5000);

                        } else {
                            notify(response.message, response.level, response.title);
                        }
                    },
                    error: function (error) {
                        var responseObject = error.responseJSON;

                        var message = responseObject.message;

                        for (var field in responseObject.errors) {
                            message += "<br><ul>";
                            for (var errorText of responseObject.errors[field]) {
                                message += ("<li>" + errorText + "</li>");
                            }
                            message += "</ul>";
                        }

                        notify(message, 'error', 'Error!');
                    }
                });
            });
        });
    </script>
@endpush
