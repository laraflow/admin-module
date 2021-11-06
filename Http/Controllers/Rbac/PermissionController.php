<?php

namespace Modules\Admin\Http\Controllers\Rbac;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Admin\Services\Rbac\PermissionService;
use Modules\Core\Services\Auth\AuthenticatedSessionService;

class PermissionController extends Controller
{
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;
    /**
     * @var PermissionService
     */
    private $permissionService;

    /**
     * @param AuthenticatedSessionService $authenticatedSessionService
     * @param PermissionService $permissionService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService,
                                PermissionService           $permissionService)
    {

        $this->authenticatedSessionService = $authenticatedSessionService;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $filters = $request->except('page');
        $permissions = $this->permissionService->permissionPaginate($filters);

        return view('admin::rbac.permission.index', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin::rbac.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionRequest $request
     * @return RedirectResponse
     * @throws Exception|\Throwable
     */
    public function store(PermissionRequest $request): RedirectResponse
    {
        $inputs = $request->except('_token');

        if ($this->permissionService->storePermission($inputs)) {
            toastr('New Permission Created', 'success', 'Notification');
            return redirect()->route('permissions.index');
        }

        toastr('Permission Creation Failed', 'error', 'Alert');
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Application|Factory|View
     * @throws Exception
     */
    public function show($id)
    {
        $withTrashed = false;

        if (\request()->has('with') && \request()->get('with') == \Constant::PURGE_MODEL_QSA) {
            $withTrashed = true;
        }

        if ($permission = $this->permissionService->getPermissionById($id, $withTrashed)) {
            return view('admin::rbac.permission.show', [
                'permission' => $permission
            ]);
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     * @throws Exception
     */
    public function edit($id)
    {
        if ($permission = $this->permissionService->getPermissionById($id)) {
            return view('admin::rbac.permission.edit', [
                'permission' => $permission
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionRequest $request
     * @param  $id
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(PermissionRequest $request, $id): RedirectResponse
    {
        $inputs = $request->except('_token', 'submit', '_method');

        if ($this->permissionService->updatePermission($inputs, $id)) {
            toastr('Permission Information Updated', 'success', 'Notification');
            return redirect()->route('permissions.index');
        }

        toastr('Permission Information Update Failed', 'error', 'Alert');
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function destroy($id, Request $request)
    {
        if ($this->authenticatedSessionService->verifyUser($request)) {

            if ($this->permissionService->destroyPermission($id)) {
                toastr('Permission Deleted', 'success', 'Notification');
            } else {
                toastr('Permission Removal Failed', 'error', 'Alert');
            }
            return redirect()->route('permissions.index');
        }
        abort(403, 'Wrong user credentials');
    }
}
