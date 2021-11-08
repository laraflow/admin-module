<?php

namespace Modules\Admin\Http\Controllers\Rbac;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\Rbac\RoleRequest;
use Modules\Admin\Services\Rbac\PermissionService;
use Modules\Admin\Services\Rbac\RoleService;
use Modules\Core\Services\Auth\AuthenticatedSessionService;
use Modules\Core\Supports\Constant;
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

        return view('admin::rbac.role.index', [
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

        return view('admin::rbac.role.create', [
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
        $confirm = $this->roleService->storeRole($request->except('_token'));

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('admin.roles.index');
        }

        notify($confirm['message'], $confirm['level'], $confirm['title']);
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

        if (request()->has('with') && request()->get('with') == Constant::PURGE_MODEL_QSA) {
            $withTrashed = true;
        }

        if ($role = $this->roleService->getRoleById($id, $withTrashed)) {
            return view('admin::rbac.role.show', [
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

            return view('admin::rbac.role.edit', [
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
        $confirm = $this->roleService->updateRole($request->except('_token', 'submit', '_method'), $id);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('roles.index');
        }

        notify($confirm['message'], $confirm['level'], $confirm['title']);
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
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('roles.index');
        }

        abort(403, 'Wrong user credentials');
    }
}
