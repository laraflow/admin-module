@extends('admin::layouts.master')

@section('title', 'Roles')

@section('keywords', 'Register, sing up')

@section('description', 'user tries to login in to system')

@push('component-styles')

@endpush

@push('page-styles')

@endpush

@section('breadcrumbs', Breadcrumbs::render(Route::getCurrentRoute()->getName()))

@section('options')
    {!! \Html::linkButton('Add Role', 'roles.create', [], 'mdi mdi-plus', 'success') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {!! Html::cardHeader('Roles',
                        'mdi mdi-account-check-outline',
                         'DataTables has most features enabled by default.') !!}
                <div class="card-body">

                    {!! \Form::open(['route' => 'roles.index', 'method' => 'get']) !!}
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                {!! \Form::search('search', old('search', (request()->get('search') ?? null)),
                                    ['class' => 'form-control', 'placeholder' =>'Search Role Name, Guard, Enabled.. etc',
                                     'aria-label' => 'Search Role Name, Guard, Enabled.. etc',
                                      'aria-describedby' => 'Search Role Name, Guard, Enabled.. etc',
                                     'id' => 'search']) !!}
                                <div class="input-group-append">
                                    {!! \Form::submit('Search', ['class' => 'btn btn-primary input-group-right-btn']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! \Form::close() !!}

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-display" id="role-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@sortablelink('name', 'Name')</th>
                                <th>@sortablelink('guard_name', 'Guard')</th>
                                <th>@sortablelink('permissions', 'Permissions')</th>
                                <th class="text-center">@sortablelink('enabled', 'Enabled')</th>
                                <th class="text-center">@sortablelink('remarks', 'Remarks')</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($roles as $index => $role)
                                <tr>
                                    <td>{{ $roles->firstItem() + $loop->index }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->guard_name }}</td>
                                    <td class="text-right">{{ $role->total_permissions }}</td>

                                    <td class="text-center">
                                        <input type="checkbox" data-toggle="toggle" data-size="small"
                                               data-onstyle="{{ $on ?? 'success' }}"
                                               data-offstyle="{{ $off ?? 'danger' }}"
                                               data-model=""
                                               data-field="enabled"
                                               data-id="{{$role->id}}"
                                               data-on="<i class='mdi mdi-check-bold fw-bolder'></i> Yes"
                                               data-off="<i class='mdi mdi-close fw-bolder'></i> No"
                                               @if($role->enabled == 'yes') checked @endif>

                                        {{--{!! \CHTML::flagChangeButton($role, 'enabled', ['yes', 'no']) !!}--}}
                                    </td>
                                    <td>{{ $role->remarks }}</td>
                                    <td>
                                        {!! \Html::actionButton('roles', $role->id, ['show', 'edit', 'delete']) !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No data to display</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {!! $roles->onEachSide(2)->appends(request()->query())->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('component-scripts')

@endpush


@push('page-scripts')
    <script>
        $(function () {
            highLightQueryString("search", "role-table");
        });
    </script>
@endpush
