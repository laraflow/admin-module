@canany([$resourceRouteName . '.exports.show', $resourceRouteName . '.edit',
        $resourceRouteName . '.destroy', $resourceRouteName . '.restore'])

    <div class="dropdown d-inline-block">
        <button class="btn btn-{{ $options['color'] ?? 'warning' }} dropdown-toggle"
                type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-sliders-h"></i>
            <span class="d-none d-md-inline-flex">Actions</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            @if(\Route::has($resourceRouteName . '.destroy'))
                @can($resourceRouteName . '.destroy')
                    <a href="{{ route('admin.common.delete', [$resourceRouteName, $id]) }}" title="Delete"
                       class="dropdown-item py-2 px-3 link-muted delete-btn">
                        <i class="fas fa-trash  mr-2"></i> Delete
                    </a>
                @endcan
            @endif

            @if(\Route::has($resourceRouteName . '.restore'))
                @can($resourceRouteName . '.restore')
                    <a href="{{ route('admin.common.delete', [$resourceRouteName, $id]) }}" title="Delete"
                       class="dropdown-item py-2 px-3 link-muted delete-btn">
                        <i class="fas fa-trash-restore  mr-2"></i> Restore
                    </a>
                @endcan
            @endif
            @canany([$resourceRouteName . '.exports.excel', $resourceRouteName . '.exports.pdf'])
                <div class="dropdown-divider"></div>
                @if(\Route::has($resourceRouteName . '.exports.excel'))
                    @can($resourceRouteName . '.exports.excel')
                        <a href="{{ route('admin.common.delete', [$resourceRouteName, $id]) }}" title="Delete"
                           class="dropdown-item py-2 px-3 link-muted delete-btn">
                            <i class="fas fa-file-csv  mr-2"></i> Bulk Import
                        </a>
                    @endcan
                @endif

                @if(\Route::has($resourceRouteName . '.exports.excel'))
                    @can($resourceRouteName . '.exports.excel')
                        <a href="{{ route('admin.common.delete', [$resourceRouteName, $id]) }}" title="Delete"
                           class="dropdown-item py-2 px-3 link-muted delete-btn">
                            <i class="fas fa-file-excel  mr-2"></i> Export XLSX
                        </a>
                    @endcan
                @endif
                @if(\Route::has($resourceRouteName . '.exports.pdf'))
                    @can($resourceRouteName . '.exports.pdf')
                        <a href="{{ route('admin.common.delete', [$resourceRouteName, $id]) }}" title="Delete"
                           class="dropdown-item py-2 px-3 link-muted delete-btn">
                            <i class="fas fa-file-pdf  mr-2"></i> Export PDF
                        </a>
                    @endcan
                @endif
            @endcanany
        </div>
    </div>
@endcanany
