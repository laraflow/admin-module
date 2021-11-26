<?php

namespace Modules\Admin\Http\Controllers\Rbac;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\Rbac\UserRequest;
use Modules\Admin\Services\Auth\AuthenticatedSessionService;
use Modules\Admin\Services\Rbac\RoleService;
use Modules\Admin\Services\Rbac\UserService;
use Modules\Admin\Supports\Utility;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var RoleService
     */
    private $roleService;
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;

    /**
     * PermissionController constructor.
     *
     * @param AuthenticatedSessionService $authenticatedSessionService
     * @param UserService $userService
     * @param RoleService $roleService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService,
                                UserService                 $userService,
                                RoleService                 $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->authenticatedSessionService = $authenticatedSessionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $filters = $request->except('page');
        $users = $this->userService->userPaginate($filters);

        return view('admin::rbac.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = $this->roleService->roleDropdown();

        return view('admin::rbac.user.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $inputs = $request->except(['_token', 'password_confirmation']);

        $photo = $request->file('photo');

        $confirm = $this->userService->storeUser($inputs, $photo);
        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('admin.users.index');
        }

        notify($confirm['message'], $confirm['level'], $confirm['title']);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function show(int $id)
    {
        if ($user = $this->userService->getUserById($id)) {
            return view('admin::rbac.user.show', [
                'user' => $user,
                'timeline' => Utility::modelAudits($user)
            ]);
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function edit(int $id)
    {
        if ($user = $this->userService->getUserById($id)) {
            $roles = $this->roleService->roleDropdown();
            $user_roles = $user->roles()->pluck('id')->toArray() ?? [];
            return view('admin::rbac.user.edit', [
                'user' => $user,
                'roles' => $roles,
                'user_roles' => $user_roles
            ]);
        }

        abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  $id
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(UserRequest $request, $id): RedirectResponse
    {
        $inputs = $request->except(['_token', 'password_confirmation']);

        $photo = $request->file('photo');

        $confirm = $this->userService->updateUser($inputs, $id, $photo);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route('admin.users.index');
        }

        notify($confirm['message'], $confirm['level'], $confirm['title']);
        return redirect()->back()->withInput();

    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @param Request $request
     * @return RedirectResponse|void
     * @throws \Throwable
     */
    public function destroy($id, Request $request)
    {
        if ($this->authenticatedSessionService->verifyUser($request)) {
            $confirm = $this->userService->destroyUser($id);
            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('admin.users.index');
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
            $confirm = $this->userService->restoreUser($id);
            if ($confirm['status'] == true) {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            } else {
                notify($confirm['message'], $confirm['level'], $confirm['title']);
            }
            return redirect()->route('admin.users.index');
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

        $userExport = $this->userService->exportUser($filters);

        $filename = 'User-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $userExport->download($filename, function ($user) use ($userExport) {
            return $userExport->map($user);
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

        $permissionExport = $this->permissionService->exportPermission($filters);

        $filename = 'Permission-' . date('Ymd-His') . '.' . ($filters['format'] ?? 'xlsx');

        return $permissionExport->download($filename, function ($permission) {
            $format = [
                '#' => $permission->id,
                'Display Name' => $permission->display_name,
                'System Name' => $permission->name,
                'Guard' => ucfirst($permission->guard_name),
                'Remarks' => $permission->remarks,
                'Enabled' => ucfirst($permission->enabled),
                'Created' => $permission->created_at->format(config('app.datetime')),
                'Updated' => $permission->updated_at->format(config('app.datetime'))
            ];
            if (AuthenticatedSessionService::isSuperAdmin()):
                $format['Deleted'] = ($permission->deleted_at != null)
                    ? $permission->deleted_at->format(config('app.datetime'))
                    : null;

                $format['Creator'] = ($permission->createdBy != null)
                    ? $permission->createdBy->name
                    : null;

                $format['Editor'] = ($permission->updatedBy != null)
                    ? $permission->updatedBy->name
                    : null;
                $format['Destructor'] = ($permission->deletedBy != null)
                    ? $permission->deletedBy->name
                    : null;
            endif;
            return $format;
        });

    }
}
