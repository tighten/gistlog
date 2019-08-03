<?php

namespace Gistlog\Http\Controllers\Auth;

use Exception;
use Gistlog\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Gistlog\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        session()->flash('redirect_to', URL::previous());

        return Socialite::driver('github')
            ->scopes(['user:email', 'gist'])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/github');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect(session()->get('redirect_to', '/'));
    }

    private function findOrCreateUser($user)
    {
        if ($authUser = User::where('github_id', $user->id)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'github_id' => $user->id,
            'avatar' => $user->avatar,
            'token' => $user->token,
        ]);
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect('/');
    }
}
