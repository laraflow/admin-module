<?php

namespace Modules\Backend\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthenticatedSessionService;
use Modules\Backend\Services\Authorization\PermissionService;
use Modules\Backend\Services\Authorization\RoleService;
use Modules\Backend\Services\Authorization\UserService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Rbac\Http\Requests\RoleRequest;
use Throwable;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @var PermissionService
     */
    private $permissionService;
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;

    /**
     * PermissionController constructor.
     *
     * @param AuthenticatedSessionService $authenticatedSessionService
     * @param RoleService $roleService
     * @param PermissionService $permissionService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService,
                                RoleService                 $roleService,
                                PermissionService           $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
        $this->authenticatedSessionService = $authenticatedSessionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $filters = $request->except('_token');
        $roles = $this->roleService->rolePaginate($filters);

        return view('backend::role.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $permissions = $this->permissionService->getAllPermissions();

        return view('backend::role.create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return RedirectResponse
     * @throws Exception|Throwable
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        $inputs = $request->except('_token');

        if ($this->roleService->storeRole($inputs)) {
            toastr('New Role Created', 'success', 'Notification');
            return redirect()->route('roles.index');
        }

        toastr('Role Creation Failed', 'error', 'Alert');
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     * @throws Exception
     */
    public function show(int $id)
    {
        $withTrashed = false;

        if (\request()->has('with') && \request()->get('with') == \Constant::PURGE_MODEL_QSA) {
            $withTrashed = true;
        }

        if ($role = $this->roleService->getRoleById($id, $withTrashed)) {
            return view('backend::role.show', [
                'role' => $role
            ]);
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     * @throws Exception
     */
    public function edit($id)
    {
        if ($role = $this->roleService->getRoleById($id)) {

            $permissions = $this->permissionService->getAllPermissions();
            $role_permissions = $role->permissions()->pluck('id')->toArray() ?? [];

            return view('backend::role.edit', [
                'role' => $role,
                'permissions' => $permissions,
                'role_permissions' => $role_permissions
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param  $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(RoleRequest $request, $id): RedirectResponse
    {
        $inputs = $request->except('_token', 'submit', '_method');

        if ($this->roleService->updateRole($inputs, $id)) {
            toastr('Role Information Updated', 'success', 'Notification');
            return redirect()->route('roles.index');
        }

        toastr('Role Information Update Failed', 'error', 'Alert');
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy($id, Request $request): RedirectResponse
    {
        if ($this->authenticatedSessionService->verifyUser($request)) {

            if ($this->roleService->destroyRole($id)) {
                toastr('Role Deleted', 'success', 'Notification');
            } else {
                toastr('Role Removal Failed', 'error', 'Alert');
            }
            return redirect()->route('roles.index');
        }

        abort(403, 'Wrong user credentials');
    }
}
