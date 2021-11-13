@extends('admin::layouts.master')

@section('title', 'Users')

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
    {!! \Html::linkButton('Add User', 'admin.users.create', [], 'mdi mdi-plus', 'success') !!}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body p-0">
                {!! \Html::cardSearch('search', 'admin.users.index', 'Search User Name, Code, Guard, Status, etc.') !!}
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="role-table">
                        <thead class="thead-light">
                        <tr>
                            <th>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                           value="option1">
                                    <label for="customCheckbox1" class="custom-control-label"></label>
                                </div>
                            </th>
                            <th>@sortablelink('name', 'Name')</th>
                            <th class="text-center">@sortablelink('guard_name', 'Guard')</th>
                            <th class="text-center">@sortablelink('permissions', 'Permissions')</th>
                            <th class="text-center">@sortablelink('users', 'Users')</th>
                            <th class="text-center">@sortablelink('enabled', 'Enabled')</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td class="exclude-search">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                               value="option1">
                                        <label for="customCheckbox1" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div class="media">
                                        <img class="align-self-center mr-3 img-circle direct-chat-img"
                                             src="{{ $user->getFirstMediaUrl('avatars') }}" alt="{{ $user->name }}">
                                        <div class="media-body">
                                            <p class="my-0">
                                                <a href="{{ route('admin.users.show', $user->id) }}">
                                                    {{ $user->name }}
                                                </a>
                                            </p>
                                            <p class="mb-0 small">{{ $user->username }}</p>
                                        </div>
                                    </div>


                                </td>
                                <td class="text-center">{{ $user->guard_name ?? '' }}</td>
                                <td class="text-center">{{ $user->total_permissions ?? '' }}</td>
                                <td class="text-center">{{ $user->total_users ?? '' }}</td>

                                <td class="text-center exclude-search">
                                    <input type="checkbox" data-toggle="toggle" data-size="small"
                                           data-onstyle="{{ $on ?? 'success' }}"
                                           data-offstyle="{{ $off ?? 'danger' }}"
                                           data-model=""
                                           data-field="enabled"
                                           data-id="{{$user->id}}"
                                           data-on="<i class='mdi mdi-check-bold fw-bolder'></i> Yes"
                                           data-off="<i class='mdi mdi-close fw-bolder'></i> No"
                                           @if($user->enabled == 'yes') checked @endif>

                                </td>
                                <td class="exclude-search pr-3 text-center">
                                    {!! \Html::actionDropdown('admin.users', $user->id, ['show', 'edit', 'delete']) !!}
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
                {!! \Modules\Admin\Supports\CHTML::pagination($users) !!}
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
