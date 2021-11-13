<?php

namespace Modules\Admin\View\Composers;

use Illuminate\View\View;
use Modules\Admin\Repositories\Eloquent\Auth\UserRepository;

class NavbarShortcutComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {

    }
}
