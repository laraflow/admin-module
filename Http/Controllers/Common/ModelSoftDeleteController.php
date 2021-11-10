<?php

namespace Modules\Core\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\Core\Http\Requests\Common\ModelSoftDeleteRequest;

class ModelSoftDeleteController extends Controller
{
    /**
     * ModelSoftDeleteController constructor.
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
     * @param ModelSoftDeleteRequest $request
     * @return Application|Factory|View
     */
    public function __invoke($route, $id, ModelSoftDeleteRequest $request)
    {
        if ($request->user()->can($route . '.destroy')) {
            return view('core::partials.delete-form', [
                'route' => $route,
                'id' => $id
            ]);
        }
        abort(403);
    }
}
