<?php

namespace Modules\Admin\Services\Auth;

use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Http\Requests\Auth\RegisterRequest;
use Modules\Admin\Models\User;
use Modules\Admin\Repositories\Eloquent\Auth\UserRepository;
use Modules\Admin\Services\Common\FileUploadService;
use Modules\Admin\Supports\Constant;
use Modules\Admin\Supports\DefaultValue;
use Modules\Admin\Supports\Utility;

class RegisteredUserService
{
    /**
     * @var UserRepository
     */
    public $userRepository;

    /**
     * @var FileUploadService
     */
    public $fileUploadService;

    /**
     * RegisteredUserService constructor.
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
     * @param RegisterRequest $registerRequest
     * @return array
     * @throws Exception
     */
    public function attemptRegistration(RegisterRequest $registerRequest): ?array
    {
        \DB::beginTransaction();
        //format request object
        $inputs = $this->formatRegistrationInfo($registerRequest);
        try {
            //create new user
            $newUser = $this->userRepository->create($inputs);
            //add profile image
            $profileImagePath = $this->fileUploadService->createAvatarImageFromText(($registerRequest->name ?? 'Guest User'));
            if ($newUser instanceof User && is_string($profileImagePath)) {
                $newUser->addMedia($profileImagePath)->toMediaCollection('avatars');
                $newUser->save();
                //$this->userRepository->manageRoles([DefaultValue::GUEST_ROLE_ID]);
                \DB::commit();
                $newUser->refresh();

                event(new Registered($newUser));
                Auth::login($newUser);

                return ['status' => true, 'message' => __('auth.register.success'), 'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Authentication'];
            } else {
                return ['status' => false, 'message' => __('auth.register.failed'), 'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Alert!'];
            }
        } catch (\Exception $exception) {
            $this->userRepository->handleException($exception);
            return ['status' => false, 'message' => __($exception->getMessage()), 'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Error!'];
        }
    }

    /**
     * @param RegisterRequest $request
     * @return array
     * @throws Exception
     */
    private function formatRegistrationInfo(RegisterRequest $request): array
    {
        //Hash password
        $inputs = [
            'name' => $request->name,
            'password' => Utility::hashPassword(($request->password ?? DefaultValue::PASSWORD)),
            'username' => ($inputs['username'] ?? Utility::generateUsername($request->name)),
            'mobile' => ($request->mobile ?? null),
            'email' => ($request->email ?? null),
            'remarks' => 'self-registered',
            'enabled' => DefaultValue::ENABLED_OPTION
        ];

        return $inputs;
    }
}
