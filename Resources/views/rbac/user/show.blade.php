@extends('admin::layouts.master')

@section('title', $user->name ?? 'Details')

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

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName(), $user))


@section('actions')
    {!! \Html::backButton('admin.users.index') !!}
    {!! \Html::editButton('admin.users.edit', $user->id) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('admin::rbac.user.partials.user-card', $user)
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-3">
                        <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab"
                                   data-toggle="pill" href="#pills-home" role="tab"
                                   aria-controls="pills-home" aria-selected="true"><strong>Profile</strong></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="pills-permission-tab"
                                   data-toggle="pill" href="#pills-permission"
                                   role="tab" aria-controls="pills-permission"
                                   aria-selected="false"><strong>Permissions</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-timeline-tab"
                                   data-toggle="pill" href="#pills-timeline"
                                   role="tab" aria-controls="pills-timeline"
                                   aria-selected="false"><strong>Timeline</strong></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                 aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="d-block">Name</label>
                                        <p class="fw-bolder">{{ $user->name ?? null }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-block">Guard(s)</label>
                                        <p class="fw-bolder">{{ $user->guard_name ?? null }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-block">Enabled</label>
                                        <p class="fw-bolder">{{ \Modules\Admin\Supports\Constant::ENABLED_OPTIONS[$user->enabled] ?? null }}</p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <label class="d-block">Remarks</label>
                                        <p class="fw-bolder">{{ $user->remarks ?? null }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-permission" role="tabpanel"
                                 aria-labelledby="pills-permission-tab">
                                <div class="accordion" id="accordionExample">
                                    @forelse($user->roles as $role)
                                        <div class="card">
                                            <h4 class="card-header mb-0 px-1 py-2" id="heading{{ $role->id }}"
                                                data-toggle="collapse" data-target="#collapse{{ $role->id }}"
                                                aria-expanded="true" aria-controls="collapse{{ $role->id }}">
                                                <i class="fa fa-user-check"></i>
                                                {{ $role->name }}
                                            </h4>
                                            <div id="collapse{{ $role->id }}" class="collapse"
                                                 aria-labelledby="heading{{ $role->id }}"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @forelse($role->permissions as $permission)
                                                            <div class="col-md-6">
                                                                <p class="text-dark fw-bold"
                                                                   title="{{ $permission->name }}">
                                                                    <i class="mdi mdi-account-key m-2"></i> {{ $permission->display_name }}
                                                                </p>
                                                            </div>
                                                        @empty
                                                            <div class="col-12 text-center fw-bolder">This Role Don't
                                                                have any
                                                                Permission/Privileges
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center font-weight-bolder">
                                            This user don't have any role(s) assigned.
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
    </div>
@endsection

@push('plugin-script')

@endpush


@push('page-script')

@endpush
