<?php


namespace Modules\Admin\Services\Rbac;


use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Modules\Admin\Http\Requests\Rbac\UserRequest;
use Modules\Admin\Models\User;
use Modules\Admin\Repositories\Eloquent\Rbac\UserRepository;
use Modules\Admin\Services\Auth\AuthenticatedSessionService;
use Modules\Admin\Services\Common\FileUploadService;
use Modules\Admin\Supports\Constant;
use Modules\Admin\Supports\DefaultValue;
use Modules\Admin\Supports\Utility;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

/**
 * Class UserService
 * @package App\Services\Preference\Preference
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var FileUploadService
     */
    private $fileUploadService;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param FileUploadService $fileUploadService
     */
    public function __construct(UserRepository    $userRepository,
                                FileUploadService $fileUploadService)
    {
        $this->userRepository = $userRepository;
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * @param array $filters
     * @param array $eagerRelations
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllUsers(array $filters = [], array $eagerRelations = [])
    {
        return $this->userRepository->getAllUserWith($filters, $eagerRelations, true);
    }

    /**
     * @param array $filters
     * @param array $eagerRelations
     * @return mixed
     * @throws Exception
     */
    public function userPaginate(array $filters = [], array $eagerRelations = [])
    {
        return $this->userRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * @param array $requestData
     * @param UploadedFile|null $photo
     * @return array
     * @throws Exception
     */
    public function storeUser(array $requestData, UploadedFile $photo = null)
    {
        //extract role id
        if (!empty($requestData['role_id'])) {
            $roleId = $requestData['role_id'];
            unset($requestData['role_id']);
        }

        //hash user password
        if (!empty($requestData['password'])) {
            $requestData['password'] = Utility::hashPassword($requestData['password']);
        }

        \DB::beginTransaction();
        //try {
        if ($newUser = $this->userRepository->create($requestData)) {
            if ($newUser instanceof User) {
                if ($this->userRepository->manageRoles($roleId) && $this->attachAvatarImage($newUser, $photo)) {
                    \DB::commit();
                    return ['status' => true, 'message' => __('New User Created'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    \DB::rollBack();
                    return ['status' => false, 'message' => __('New User Creation Failed'),
                        'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
                }
            }
        }
        /* } catch (Exception $exception) {
            throw new \Exception($exception->getMessage());
           // $this->userRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }*/
    }

    /**
     * @param string $roleName
     * @return mixed
     * @throws Exception
     */
    public function getUsersByRoleName(string $roleName)
    {
        try {
            return $this->userRepository->usersByRole($roleName);
        } catch (Exception $exception) {
            $this->userRepository->handleException($exception);
            return [];
        }
    }

    /**
     * @param $id
     * @param bool $purge
     * @return mixed|null
     * @throws Exception
     */
    public function getUserById($id, bool $purge = false)
    {
        if($purge == false) {
            $purge = AuthenticatedSessionService::isSuperAdmin();
        }

        return $this->userRepository->show($id, $purge);
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @param array $roleId
     * @return bool
     * @throws \Throwable
     */
    public function updateUser(UserRequest $request, $id, array $roleId = [DefaultValue::GUEST_ROLE_ID]): bool
    {
        $requestData = $request->except(['_token', 'password_confirmation']);

        //extract role id
        if (!empty($requestData['role_id'])) {
            $roleId = $requestData['role_id'];
        }

        //hash user password or remove password field
        if (!empty($requestData['password']))
            $requestData['password'] = Utility::hashPassword($requestData['password']);
        else
            unset($requestData['password']);

        \DB::beginTransaction();
        try {
            //check if user is available or not
            if ($selectUserModel = $this->getUserById($id)) {
                if ($this->userRepository->update($requestData, $selectUserModel->id)) {
                    $confirm = $this->userRepository->manageRoles($roleId, true);
                    //update profile image
                    if ($request->hasFile('photo')) {
                        $profileImagePath = $this->fileUploadService->createAvatarImageFromInput($request->file('photo'));
                        $selectUserModel->addMedia($profileImagePath)->toMediaCollection('avatars');
                        $selectUserModel->save();
                    }

                    //DB Commit
                    if ($confirm == true) {
                        \DB::commit();
                        return true;
                    }
                }
                return false;
            }
            return false;
        } catch (Exception $exception) {
            \DB::rollBack();
            $this->userRepository->handleException($exception);
            return false;
        }
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function destroyUser($id): array
    {
        \DB::beginTransaction();
        try {
            if ($this->userRepository->delete($id)) {
                \DB::commit();
                return ['status' => true, 'message' => __('User is Trashed'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('User is Delete Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (\Exception $exception) {
            $this->userRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }


    /**
     * @param User $user
     * @param UploadedFile|null $photo
     * @return bool
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws Exception
     */
    public function attachAvatarImage(User $user, UploadedFile $photo = null): bool
    {
        //add profile image
        if ($photo != null) {
            $profileImagePath = $this->fileUploadService->createAvatarImageFromInput($photo);
        } else {
            $profileImagePath = $this->fileUploadService->createAvatarImageFromText($user->name);
        }

        $user->addMedia($profileImagePath)->toMediaCollection('avatars');
        return $user->save();
    }

    /**
     * @param $id
     * @return array
     * @throws \Throwable
     */
    public function restoreUser($id): array
    {
        \DB::beginTransaction();
        try {
            if ($this->userRepository->restore($id)) {
                \DB::commit();
                return ['status' => true, 'message' => __('User is Restored'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];

            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('User is Restoration Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->userRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }
}
