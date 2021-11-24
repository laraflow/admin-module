<?php

namespace Modules\Admin\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\Admin\Http\Requests\Common\ModelRestoreRequest;
use Modules\Admin\Http\Requests\Common\ModelSoftDeleteRequest;

class ModelRestoreController extends Controller
{
    /**
     * ModelRestoreController constructor.
     *
     */
    public function __construct()
    {

    }

    /**
     * Change a model status from enabled to disabled ro vise-versa.
     *
     * @param $route
     * @param $id
     * @param ModelRestoreRequest $request
     * @return Application|Factory|View
     */
    public function __invoke($route, $id, ModelRestoreRequest $request)
    {
        if ($request->user()->can($route . '.restore')) {
            return view('admin::layouts.partials.confirm-form', [
                'route' => [$route . '.restore', $id],
                'method' => 'patch'
            ]);
        }
        abort(403);
    }
}
