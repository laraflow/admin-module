<?php

namespace Modules\Admin\Http\Controllers\Rbac;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Admin\Http\Requests\Rbac\RolePermissionRequest;
use Modules\Admin\Http\Requests\Rbac\RoleRequest;
use Modules\Admin\Services\Auth\AuthenticatedSessionService;
use Modules\Admin\Services\Rbac\PermissionService;
use Modules\Admin\Services\Rbac\RoleService;
use Modules\Admin\Supports\Constant;
use Modules\Admin\Supports\Utility;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;

    /**
     * @var PermissionService
     */
    private $permissionService;

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

        return view('admin::rbac.role.create');
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
        if ($role = $this->roleService->getRoleById($id)) {

            $permissions = $this->permissionService->getAllPermissions([
                'sort' => 'display_name', 'direction' => 'asc'
            ]);

            $availablePermissionIds = $role->permissions()->pluck('id')->toArray();

            return view('admin::rbac.role.show', [
                'role' => $role,
                'permissions' => $permissions,
                'availablePermissionIds' => $availablePermissionIds,
                'timeline' => Utility::modelAudits($role)
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

            return view('admin::rbac.role.edit', ['role' => $role]);
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
            return redirect()->route('admin.roles.index');
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
    public function destroy($id, Request $request)
    {
        if ($this->authenticatedSessionService->verifyUser($request)) {
            $confirm = $this->roleService->destroyRole($id);
            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('admin.roles.index');
        }
        abort(403, 'Wrong user credentials');
    }

    /**
     * Restore a Soft Deleted Resource
     *
     * @param $id
     * @param Request $request
     * @return RedirectResponse|void
     * @throws \Throwable
     */
    public function restore($id, Request $request)
    {
        if ($this->authenticatedSessionService->verifyUser($request)) {
            $confirm = $this->roleService->restoreRole($id);
            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('admin.roles.index');
        }
        abort(403, 'Wrong user credentials');
    }



    /**
     * Return an Import view page
     *
     * @return Application|Factory|View
     */
    public function import()
    {
        return view('admin::rbac.permission.import');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws Exception
     */
    public function importBulk(Request $request)
    {
        $filters = $request->except('page');
        $permissions = $this->permissionService->getAllPermissions($filters);

        return view('admin::rbac.permission.index', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return string|StreamedResponse
     * @throws Exception
     */
    public function export(Request $request)
    {
        $filters = $request->except('page');

        $roleExport = $this->roleService->exportRole($filters);

        $filename = 'Role-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $roleExport->download($filename, function ($role) use ($roleExport) {
            return $roleExport->map($role);
        });

    }

    /**
     * Display a detail of the resource.
     *
     * @return StreamedResponse|string
     * @throws Exception
     */
    public function print(Request $request)
    {

        $filters = $request->except('page');

        $roleExport = $this->roleService->exportRole($filters);

        $filename = 'Role-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $roleExport->download($filename, function ($role) {
            $format = [
                '#' => $role->id,
                'Display Name' => $role->display_name,
                'System Name' => $role->name,
                'Guard' => ucfirst($role->guard_name),
                'Remarks' => $role->remarks,
                'Enabled' => ucfirst($role->enabled),
                'Created' => $role->created_at->format(config('app.datetime')),
                'Updated' => $role->updated_at->format(config('app.datetime'))
            ];
            if (AuthenticatedSessionService::isSuperAdmin()):
                $format['Deleted'] = ($role->deleted_at != null)
                    ? $role->deleted_at->format(config('app.datetime'))
                    : null;

                $format['Creator'] = ($role->createdBy != null)
                    ? $role->createdBy->name
                    : null;

                $format['Editor'] = ($role->updatedBy != null)
                    ? $role->updatedBy->name
                    : null;
                $format['Destructor'] = ($role->deletedBy != null)
                    ? $role->deletedBy->name
                    : null;
            endif;
            return $format;
        });

    }

    /**
     * @param $id
     * @param RolePermissionRequest $request
     * @return JsonResponse|void
     * @throws Exception
     */
    public function permission($id, RolePermissionRequest $request)
    {
        if ($request->ajax()) {

            $jsonResponse = ['message' => null, 'errors' => []];

            if ($role = $this->roleService->getRoleById($id)) {
                $roles = $request->get('permissions', []);
                $confirm = $this->roleService->syncPermission($id, $roles);

                //formatted response is collected from service
                return response()->json(array_merge($jsonResponse, $confirm));

            } else {
                throw ValidationException::withMessages([
                    'role' => 'Invalid Role Id Provided'
                ]);
            }
        }

        abort(403);
    }
}
