@extends('admin::layouts.master')

@section('title', 'Roles')

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

@section('breadcrumbs', \Breadcrumbs::render())

@section('actions')
    {!! \Html::linkButton('Add Role', 'admin.roles.create', [], 'mdi mdi-plus', 'success') !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body p-0">
                {!! \Html::cardSearch('search', 'admin.roles.index', 'Search Role Name, Code, Guard, Status, etc.') !!}
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="role-table">
                        <thead class="thead-light">
                        <tr>
                            <th class="align-middle">
                                @sortablelink('id', '#')
                            </th>
                            <th>@sortablelink('name', 'Name')</th>
                            <th class="text-center">@sortablelink('guard_name', 'Guard')</th>
                            <th class="text-center">@sortablelink('permissions', 'Permissions')</th>
                            <th class="text-center">@sortablelink('users', 'Users')</th>
                            <th class="text-center">@sortablelink('enabled', 'Enabled')</th>
                            <th class="text-center">@sortablelink('created_at', 'Created')</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $index => $role)
                            <tr  @if($role->deleted_at != null) class="table-danger" @endif>
                                <td class="exclude-search align-middle">
                                    {{ $role->id }}
                                </td>
                                <td class="text-left">
                                    @if(auth()->user()->can('admin.roles.show') || in_array($role->id, auth()->user()->role_ids))
                                        <a href="{{ route('admin.roles.show', $role->id) }}">
                                            {{ $role->name }}
                                        </a>
                                    @else
                                        {{ $role->name }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $role->guard_name }}</td>
                                <td class="text-center">{{ $role->total_permissions }}</td>
                                <td class="text-center">{{ $role->total_users }}</td>

                                <td class="text-center exclude-search">
                                    {!! \Html::enableToggle($role) !!}
                                </td>
                                <td class="text-center">{{ $role->created_at->format(config('app.datetime')) ?? '' }}</td>
                                <td class="exclude-search pr-3 text-center align-middle">
                                    {!! \Html::actionDropdown('admin.roles', $role->id, array_merge(['show', 'edit'], ($role->deleted_at == null) ? ['delete'] : ['restore'])) !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="exclude-search text-center">No data to display</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-transparent pb-0">
                {!! \Modules\Admin\Supports\CHTML::pagination($roles) !!}
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection


@push('plugin-script')

@endpush

@push('page-script')
    <script>
        $(function () {
            highLightQueryString('search', 'role-table');
        });
    </script>
@endpush
