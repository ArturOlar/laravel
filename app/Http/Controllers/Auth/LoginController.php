<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/news';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $userRepository;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->userRepository = new UserRepository();
    }

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function authFacebook()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        $userData = Socialite::driver('facebook')->user();
        $user = $this->userRepository->getOrCreateUserBySocData($userData, 'facebook');
        Auth::login($user);
        return redirect()->route('home');
    }

    public function authGithub()
    {
        return Socialite::with('github')->redirect();
    }

    public function callbackGithub()
    {
        $userData = Socialite::driver('github')->user();
        $user = $this->userRepository->getOrCreateUserBySocData($userData, 'github');
        Auth::login($user);
        return redirect()->route('home');
    }
}
