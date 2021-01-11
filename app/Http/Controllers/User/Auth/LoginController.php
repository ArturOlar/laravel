<?php

namespace App\Http\Controllers\User\Auth;

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
//    protected $redirectTo = '/admin/news';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $userRepository;

    protected function authenticated()
    {
        if(Auth::user()->is_admin == 1) {
            return redirect('/admin/news');
        } else {
            return redirect('/');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->userRepository = new UserRepository();
    }

    // показ шаблона
    public function showLoginForm()
    {
        return view('user.auth.login');
    }
    
    // авторизация через фейсбук
    public function authFacebook()
    {
        return Socialite::with('facebook')->redirect();
    }

    // редирект из фейсбука на сайт
    public function callbackFacebook()
    {
        $userData = Socialite::driver('facebook')->user();
        $user = $this->userRepository->getOrCreateUserBySocData($userData, 'facebook');
        Auth::login($user);
        return redirect()->route('home');
    }

    // авториазция через гитхаб
    public function authGithub()
    {
        return Socialite::with('github')->redirect();
    }

    // редирект из гитхаба на сайт
    public function callbackGithub()
    {
        $userData = Socialite::driver('github')->user();
        $user = $this->userRepository->getOrCreateUserBySocData($userData, 'github');
        Auth::login($user);
        return redirect()->route('home');
    }

    // авторизация через gmail
    public function authGoogle()
    {
        return Socialite::with('google')->redirect();
    }

    // редирект из gmail на сайт
    public function callbackGoogle()
    {
        $userData = Socialite::driver('google')->user();
        $user = $this->userRepository->getOrCreateUserBySocData($userData, 'google');
        Auth::login($user);
        return redirect()->route('home');
    }
}
