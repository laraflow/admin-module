<?php

namespace Modules\Admin\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\Admin\Models\User;

class UserDropDownComposer
{

    /**
     * @var User $user
     */
    public $user;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();

        dd($this->user);
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
