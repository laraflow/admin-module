<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserSeeder extends Seeder
{
    /**
     * @var RegisteredUserService
     */
    private $registeredUserService;

    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * UserSeeder constructor.
     * @param RegisteredUserService $registeredUserService
     * @param UserRepository $userRepository
     */
    public function __construct(RegisteredUserService $registeredUserService,
                                UserRepository        $userRepository)
    {
        $this->registeredUserService = $registeredUserService;
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception|\Throwable
     */
    public function run()
    {
        Model::unguard();
        //disable Observer
        $eventDispatcher = User::getEventDispatcher();
        User::unsetEventDispatcher();

        //Default User "Ami"

        try {
            $newUser = [
                'name' => 'Mohammad Hafijul Islam',
                'username' => 'hafijul233',
                'email' => 'hafijul233@gmail.com',
                'password' => '123456789'
            ];

            if ($newRegisteredUser = $this->registeredUserService->attemptRegistration($newUser)) {
                $this->userRepository->setModel($newRegisteredUser);
                $adminRole = Role::findByName('Super Administration');
                $feedback = $this->userRepository->manageRoles([$adminRole->id]);
            }
            //TODO else part
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
        }

        //Enable observer
        User::setEventDispatcher($eventDispatcher);

    }
}
