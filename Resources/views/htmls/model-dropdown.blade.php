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
            @if(\Route::has($resourceRouteName . '.edit'))
                @can($resourceRouteName . '.edit')
                    <a href="{{ route($resourceRouteName . '.edit', $id) }}" title="Edit"
                       class="dropdown-item py-2 px-3 link-muted">
                        <i class="fas fa-edit mr-2"></i> Edit</a>
                @endcan
            @endif

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
                @if(\Route::has($resourceRouteName . '.exports.show'))
                    @can($resourceRouteName . '.exports.show')
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.common.delete', [$resourceRouteName, $id]) }}" title="Delete"
                           class="dropdown-item py-2 px-3 link-muted delete-btn">
                            <i class="fas fa-print  mr-2"></i> Print
                        </a>
                    @endcan
                @endif
        </div>
    </div>
@endcanany
{{--    <div class="d-flex justify-content-center">
        <a id="actions1Invoker"
           class="link-muted " href="#!"
           aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">

        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown"
             style="width: 150px; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(898px, 169px, 0px);"
             aria-labelledby="actions1Invoker" x-placement="bottom-end">
            <ul class="list-unstyled mb-0">
                @if(in_array('show', $options) && Route::has($resourceRouteName . '.show'))
                    @can($resourceRouteName . '.show')
                        <li>
                            <a href="{{ route($resourceRouteName . '.show', $id) }}" title="Show"
                               class="d-flex align-items-center link-muted py-2 px-3">
                                <i class="mdi mdi-eye fw-bold"></i> Details
                            </a>
                        </li>
                    @endcan
                @endif



                @if(in_array('delete', $options) && Route::has($resourceRouteName . '.destroy'))
                    --}}{{--@can($resourceRouteName . '.destroy')--}}{{--
                    <li>
                        <a href="{{  }}" title="Show"
                           class="d-flex align-items-center link-muted py-2 px-3 delete-btn">
                            <i class="mdi mdi-close-thick fw-bold mr-1"></i> Delete
                        </a>
                    </li>
                    --}}{{--@endcan--}}{{--
                @endif

                @if(in_array('delete', $options) && Route::has($resourceRouteName . '.restore'))
                    @can($resourceRouteName . '.restore')
                        <li>
                            <a href="{{ route($resourceRouteName . '.restore', $id) }}" title="Show"
                               class="d-flex align-items-center link-muted py-2 px-3">
                                <i class="mdi mdi-delete-restore fw-bold mr-1"></i> Restore
                            </a>
                        </li>
                    @endcan
                @endif
            </ul>
        </div>
    </div>
    --}}{{--@endcanany--}}
