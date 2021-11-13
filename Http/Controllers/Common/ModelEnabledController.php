<?php

namespace Modules\Admin\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Http\Requests\Common\ModelEnabledRequest;
use Modules\Admin\Supports\Constant;
use Modules\Admin\Supports\DefaultValue;

class ModelEnabledController extends Controller
{
    /**
     *
     */
    protected $userService;

    /**
     * ModelEnabledController constructor.
     *
     */
    public function __construct()
    {
    }

    /**
     * Change a model status from enabled to disabled ro vise-versa.
     *
     * @param ModelEnabledRequest $request
     * @return JsonResponse|void
     */
    public function __invoke(ModelEnabledRequest $request)
    {
        if ($request->ajax()) {
            $model_path = $request->get('m'); // Model Full namespace Location
            $primary_id = $request->get('i');
            $update_value = $request->get('v');

            try {
                $model = $model_path::find($primary_id);
                $model->enabled = strtolower($update_value);
                $model->save();

                if ($update_value == DefaultValue::ENABLED_OPTION)
                    return response()->json(['status' => true, 'message' => __('Status Enabled Successful'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification'], 200);

                else
                    return response()->json(['status' => true, 'message' => __('Status Disabled Successful'),
                        'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Notification'], 200);

            } catch (\Exception $exception) {

                \Log::error($exception->getMessage());

                return response()->json(['status' => false, 'message' => $exception->getMessage(),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Error!'], 422);
            }
        } else {
            abort(403);
        }
    }
}
