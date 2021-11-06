{{--<div class="d-flex justify-content-center">
    <a id="actions1Invoker"
    class="link-muted" href="#!"
    aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
        <i class="fa fa-sliders-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown"
    style="width: 150px; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(898px, 169px, 0px);"
     aria-labelledby="actions1Invoker" x-placement="bottom-end">
        <ul class="list-unstyled mb-0">
        @if(in_array('show', $options) && Route::has($resourceRouteName . '.show'))
            @can($resourceRouteName . '.show'))
                <li>
                    <a href="{{ route($resourceRouteName . '.show', $id) }}" title="Show"
                    class="d-flex align-items-center link-muted py-2 px-3">
                        <i class="mdi mdi-eye-outline fw-bold"></i> Details
                    </a>
                </li>
            @endcan
        @endif
        @if(in_array('edit', $options) && Route::has($resourceRouteName . '.edit'))
            @can($resourceRouteName . '.edit'))
                <li>
                    <a href="{{ route($resourceRouteName . '.edit', $id) }}" title="Show"
                    class="d-flex align-items-center link-muted py-2 px-3">
                    <i class="mdi mdi-square-edit-outline fw-bold"></i> Edit
                    </a>
                </li>
            @endcan
        @endif
        @if(in_array('delete', $options) && Route::has($resourceRouteName . '.destory'))
            @can($resourceRouteName . '.destory'))
                <li>
                    <a href="{{ route($resourceRouteName . '.destroy', $id) }}" title="Show"
                    class="d-flex align-items-center link-muted py-2 px-3">
                    <i class="mdi mdi-close-thick fw-bold"></i> Details
                    </a>
                </li>
            @endcan
        @endif
            <li>
                <a class="d-flex align-items-center link-muted py-2 px-3" href="#!">
                    <i class="fa fa-plus mr-2"></i> Add
                </a>
            </li>
            <li>
                <a class="d-flex align-items-center link-muted py-2 px-3" href="#!">
                    <i class="fa fa-minus mr-2"></i> Remove
                </a>
            </li>
        </ul>
    </div>
</div>--}}
{{--    @if(in_array('show', $options) && Route::has($resourceRouteName . '.show')
        @can($resourceRouteName . '.show'))
        <a href="{{ route($resourceRouteName . '.show', $id) }}" title="Show"
           class="btn btn-success btn-sm mx-1">
            <i class="mdi mdi-eye-outline fw-bold"></i>
        </a>
{{--    @endif

    @if(in_array('edit', $options) && Route::has($resourceRouteName . '.edit')
        @can($resourceRouteName . '.edit'))
        <a href="{{ route($resourceRouteName . '.edit', $id) }}" title="Edit"
           class="btn btn-warning btn-sm mx-1">
            <i class="mdi mdi-square-edit-outline fw-bold"></i>
        </a>
{{--    @endif
    @if(in_array('delete', $options) && Route::has($resourceRouteName . '.destroy')
        @can($resourceRouteName . '.destroy'))
        <a href="{{ route('common.delete', [$resourceRouteName, $id]) }}" title="Delete"
           class="btn btn-danger btn-sm mx-1 delete-btn">
            <i class="mdi mdi-close-thick fw-bold"></i>
        </a>
{{--    @endif

    @if(in_array('restore', $options) && Route::has($resourceRouteName . '.restore')
        @can($resourceRouteName . '.restore'))
{{--        <a href="{{ route($resourceRouteName . '.restore', $id) }}" title="Restore"
           class="btn btn-secondary btn-sm mx-1">
            <i class="mdi mdi-delete-restore fw-bold"></i>
        </a>
{{--    @endif
</div>
