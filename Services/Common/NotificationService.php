<?php


namespace Modules\Core\Services\Common;



use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Modules\Core\Models\User;
use Modules\Core\Repositories\Eloquent\Auth\UserRepository;

class NotificationService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * PermissionService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->userRepository->itemsPerPage = 10;
    }

    /**
     * @param $userId
     * @return mixed
     * @throws Exception
     */
    public function getAllNotifications($userId)
    {
        $user = $this->userRepository->show($userId);

        return $user->notifications;
    }

    /**
     * @param array $filters
     * @param array $eagerRelations
     * @return mixed
     * @throws Exception
     */
    public function rolePaginate(array $filters = [], array $eagerRelations = [])
    {
        return $this->userRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * @param string $id
     * @return Notification|null
     * @throws Exception
     */
    public function getNotificationById(string $id): ?Notification
    {
        try {
            /**
             * @var User $currentUser
             */
            $currentUser = auth()->user();

            /**
             * @var Notification $notification
             */
            $notification = $currentUser->notifications()->where('id', $id)->get();

            return $notification;

        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @param array $inputs
     * @return Model
     * @throws Exception
     */
    public function storeNotification(array $inputs): Model
    {
        return $this->userRepository->create($inputs);
    }

    /**
     * @param array $inputs
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function updateNotification(array $inputs, $id): bool
    {
        return $this->userRepository->update($inputs, $id);
    }


    /**
     * @param array $filters
     * @return array
     */
    public function notificationDropdown(array $filters = []): array
    {
        $roleCollection = $this->userRepository->all();
        $roles = [];
        foreach ($roleCollection as $role)
            $roles[$role->id] = $role['name'];

        return $roles;
    }
}
