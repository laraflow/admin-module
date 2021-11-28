<?php


namespace Modules\Admin\Services\Rbac;


use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;
use Modules\Admin\Exports\Rbac\UserXLSImport;
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
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function userPaginate(array $filters = [], array $eagerRelations = []): LengthAwarePaginator
    {
        return $this->userRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * @param array $requestData
     * @param UploadedFile|null $photo
     * @return array
     * @throws Exception
     */
    public function storeUser(array $requestData, UploadedFile $photo = null): array
    {
        $roleId = [DefaultValue::GUEST_ROLE_ID];

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
        try {
            if ($newUser = $this->userRepository->create($requestData)) {
                if (($newUser instanceof User) && $this->userRepository->manageRoles($roleId) && $this->attachAvatarImage($newUser, $photo)) {
                    \DB::commit();
                    return ['status' => true, 'message' => __('New User Created'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    \DB::rollBack();
                    return ['status' => false, 'message' => __('Role or Avatar image Failed'),
                        'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Warning!'];
                }
            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('New User Creation Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            $this->userRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
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
        if ($purge == false) {
            $purge = AuthenticatedSessionService::isSuperAdmin();
        }

        return $this->userRepository->show($id, $purge);
    }

    /**
     * @param array $requestData
     * @param $id
     * @param UploadedFile|null $photo
     * @return array
     * @throws Exception
     */
    public function updateUser(array $requestData, $id, UploadedFile $photo = null): array
    {
        $roleId = [DefaultValue::GUEST_ROLE_ID];
        //extract role id
        if (!empty($requestData['role_id'])) {
            $roleId = $requestData['role_id'];
            unset($requestData['role_id']);
        }
        //hash user password
        if (!empty($requestData['password'])) {
            $requestData['password'] = Utility::hashPassword($requestData['password']);
        } else {
            unset($requestData['password']);
        }

        \DB::beginTransaction();
        try {
            //check if user is available or not
            if ($selectUserModel = $this->getUserById($id)) {
                $this->userRepository->setModel($selectUserModel);
                if ($this->userRepository->update($requestData, $id) && $this->userRepository->manageRoles($roleId)) {
                    //update profile image
                    if ($photo != null) {
                        $profileImagePath = $this->fileUploadService->createAvatarImageFromInput($photo);
                        $selectUserModel->addMedia($profileImagePath)->toMediaCollection('avatars');
                        $selectUserModel->save();
                    }
                    \DB::commit();
                    return ['status' => true, 'message' => __('User Information Updated'),
                        'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
                } else {
                    \DB::rollBack();
                    return ['status' => false, 'message' => __('User Information Update Failed'),
                        'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
                }
            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('Invalid User ID Update Failed'),
                    'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Alert!'];
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
            /*            $this->userRepository->handleException($exception);*/
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
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

    /**
     * Export Object for Export Download
     *
     * @param array $filters
     * @return UserXLSImport
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function exportUser(array $filters = []): UserXLSImport
    {
        return (new UserXLSImport($this->userRepository->getAllUserWith($filters)));
    }
}
