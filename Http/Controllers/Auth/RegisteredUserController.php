<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Admin\Http\Requests\Auth\RegisterRequest;
use Modules\Admin\Services\Auth\RegisteredUserService;

class RegisteredUserController extends Controller
{
    /**
     * @var RegisteredUserService
     */
    private $registeredUserService;

    /**
     * RegisteredUserController constructor.
     * @param RegisteredUserService $registeredUserService
     */
    public function __construct(RegisteredUserService $registeredUserService)
    {
        $this->registeredUserService = $registeredUserService;
    }

    /**
     * Display the registration view.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin::auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $confirm = $this->registeredUserService->attemptRegistration($request);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->intended(config('backend.config.home_url'));
        } else {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->back();
        }
    }
}
