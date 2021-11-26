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
    {!! \Html::modelDropdown('admin.permissions', $permission->id, ['color' => 'success']) !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header p-3">
                <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab"
                           data-toggle="pill" href="#pills-home" role="tab"
                           aria-controls="pills-home" aria-selected="true"><strong>Details</strong></a>
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
                    <div class="tab-pane fade" id="pills-timeline" role="tabpanel"
                         aria-labelledby="pills-timeline-tab">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                        @forelse($timeline as $date => $actions)
                            <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-info">
                                        {{ date('d M. Y', strtotime($date)) }}
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                            @foreach($actions as $action)
                                <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($action->created_at)->format('h:i a')  }}</span>
                                            <h3 class="timeline-header">
                                                <a href="{{ route('admin.users.show', $action->user->id) }}">
                                                    {{ $action->user->name }}</a> {{ ucwords($action->event) }} this
                                                permission
                                            </h3>

                                            <div class="timeline-body">
                                                <table class="table table-striped table-bordered">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            Event
                                                        </td>
                                                        <td>
                                                            {{ ucwords($action->event) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            IP Address
                                                        </td>
                                                        <td>
                                                            {{ $action->ip_address }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            User Agent
                                                        </td>
                                                        <td>
                                                            {{ $action->user_agent }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Old Value
                                                        </td>
                                                        <td>
                                                            @dump($action->old_values)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            New Value
                                                        </td>
                                                        <td>
                                                            @dump($action->new_values)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Entry DateTime
                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($action->created_at)->format(config('app.datetime')) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Update DateTime
                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($action->updated_at)->format(config('app.datetime')) }}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                @endforeach
                            @empty
                                ""
                            @endforelse
                            <div>
                                <i class="far fa-clock bg-gray"></i>
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

