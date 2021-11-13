<?php


namespace Modules\Admin\Services\Rbac;


use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Http\Requests\Rbac\UserRequest;
use Modules\Admin\Models\User;
use Modules\Admin\Repositories\Eloquent\UserRepository;
use Modules\Admin\Services\Common\FileUploadService;
use Modules\Admin\Supports\DefaultValue;
use Modules\Admin\Supports\Utility;

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
     * @param array $filers
     * @return Collection|Model[]
     */
    public function getAllUsers(array $filers = [])
    {
        return $this->userRepository->all();
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
     * @param UserRequest $request
     * @param array $roleId
     * @return bool
     * @throws \Throwable
     */
    public function storeUser(UserRequest $request, array $roleId = [DefaultValue::GUEST_ROLE_ID]): bool
    {

        $requestData = $request->except(['_token', 'password_confirmation']);
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
                if ($newUser instanceof User) {
                    //confirm user
                    $confirm = $this->userRepository->manageRoles($roleId);

                    //add profile image
                    if ($request->hasFile('photo'))
                        $profileImagePath = $this->fileUploadService->createAvatarImageFromInput($request->file('photo'));
                    else
                        $profileImagePath = $this->fileUploadService->createAvatarImageFromText($requestData['name']);

                    $newUser->addMedia($profileImagePath)->toMediaCollection('avatars');
                    $newUser->save();

                    //DB Commit
                    if ($confirm == true) {
                        \DB::commit();
                        return true;
                    }
                }
            }
            return false;
        } catch (Exception $exception) {
            \DB::rollBack();
            $this->userRepository->handleException($exception);
            return false;
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
     * @return bool
     * @throws \Throwable
     */
    public function destroyRole($id): bool
    {
        \DB::beginTransaction();
        try {
            if ($this->userRepository->delete($id)) {
                \DB::commit();
                return true;
            } else {
                \DB::rollBack();
                return false;
            }
        } catch (\Exception $exception) {
            $this->userRepository->handleException($exception);
            \DB::rollBack();
            return false;
        }
    }
}
