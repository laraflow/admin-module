<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\Auth\LoginRequest;
use Modules\Admin\Services\Auth\AuthenticatedSessionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * @class AuthenticatedSessionController
 * @package Modules\Admin\Http\Controllers\Auth
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;

    /**
     * @param AuthenticatedSessionService $authenticatedSessionService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService)
    {
        $this->authenticatedSessionService = $authenticatedSessionService;
    }

    /**
     * Display the login view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('core::auth.login');
    }

    /**
     * Handle an incoming auth request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        \Log::info("Log Info: " . json_encode($request->all()));
        $confirm = $this->authenticatedSessionService->attemptLogin($request);

        if ($confirm['status'] == true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->intended(config('backend.config.home_url'));
        } else {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->back();
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
