@extends('admin::layouts.master')

@section('title', 'Permissions')

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
    {!! \Html::linkButton('Add Permission', 'admin.permissions.create', [], 'mdi mdi-plus', 'success') !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body p-0">
                {!! \Html::cardSearch('search', 'admin.permissions.index', 'Search Permission Display Name, Code, Guard, Status, etc.') !!}
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="permission-table">
                        <thead class="thead-light">
                        <tr>
                            <th>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                           value="option1">
                                    <label for="customCheckbox1" class="custom-control-label"></label>
                                </div>
                            </th>
                            <th>@sortablelink('display_name', 'Display Name')</th>
                            <th>@sortablelink('name', 'Name')</th>
                            <th>@sortablelink('guard_name', 'Guard')</th>
                            <th class="text-center">@sortablelink('enabled', 'Enabled')</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($permissions as $index => $permission)
                            <tr>
                                <td class="exclude-search">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                               value="option1">
                                        <label for="customCheckbox1" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="text-left">
                                    <a href="{{ route('admin.permissions.show', $permission->id) }}">
                                        {{ $permission->display_name }}
                                    </a>
                                </td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <td class="text-center exclude-search">
                                    <input type="checkbox" data-toggle="toggle" data-size="small"
                                           data-onstyle="{{ $on ?? 'success' }}"
                                           data-offstyle="{{ $off ?? 'danger' }}"
                                           data-model=""
                                           data-field="enabled"
                                           data-id="{{$permission->id}}"
                                           data-on="<i class='mdi mdi-check-bold fw-bolder'></i> Yes"
                                           data-off="<i class='mdi mdi-close fw-bolder'></i> No"
                                           @if($permission->enabled == 'yes') checked @endif>

                                </td>
                                <td class="exclude-search pr-3 text-center">
                                    {!! \Html::actionDropdown('admin.permissions', $permission->id, ['show', 'edit', 'delete']) !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="exclude-search text-center">No data to display</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-transparent pb-0">
                {!! \Modules\Admin\Supports\CHTML::pagination($permissions) !!}
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
            highLightQueryString('search', 'permission-table');
        });
    </script>
@endpush