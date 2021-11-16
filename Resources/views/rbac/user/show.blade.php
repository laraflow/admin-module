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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Permissions</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            {{--                    <div class="row">
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
                    </div>--}}
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                        </div>
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
