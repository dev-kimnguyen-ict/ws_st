<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;

/**
 * Class SocialController
 *
 * @package App\Http\Controllers\Auth
 */
class SocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param string $driver
     * @return mixed
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * Handle social login
     *
     * @param $socialDriver
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($socialDriver)
    {
        /** @var ProviderInterface $driver */
        $driver = Socialite::driver($socialDriver);
        $loginPath = $this->loginPath();

        try {
            $socialUser = $driver->user();
        } catch (InvalidStateException $e) {
            return redirect()->intended($loginPath)->withErrors(['social' => trans('auth.invalid_state')]);
        } catch (ClientException $e) {
            return redirect()->intended($loginPath)->withErrors(['social' => trans('auth.expired_state')]);
        } catch (ServerException $e) {
            return redirect()->intended($loginPath)->withErrors(['social' => trans('auth.social_network_error')]);
        }

        return $this->loginExistingUser($socialDriver, $socialUser);
    }


    /**
     * Obtain the user information from OAuth2 Service.
     *
     * @param string $socialDriver
     * @param \Laravel\Socialite\Two\User $socialUser
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function loginExistingUser($socialDriver, $socialUser)
    {
        $social = Social::findByServiceId($socialUser->id, $socialDriver);
        $social = $social ?: $this->makeSocial($socialDriver, $socialUser);

        $user = !$social->wasRecentlyCreated ? $this->createSocialUser($socialUser, $social) : $social->user;

        return $this->login($user);
    }

    /**
     * Make social
     *
     * @param string $socialDriver
     * @param \Laravel\Socialite\Two\User $socialUser
     * @return Social
     */
    private function makeSocial($socialDriver, $socialUser)
    {
        $social = new Social();
        $social->user_provider_id = $socialUser->id;
        $social->provider = $socialDriver;

        return $social;
    }

    /**
     * Make user
     *
     * @param \Laravel\Socialite\Two\User $socialUser
     * @param Social $social
     * @return User
     */
    private function createSocialUser($socialUser, $social)
    {
        /** @var User $account */
        $account = User::where('email', $socialUser->getEmail())->first();
        $gender = strtolower($socialUser->user['gender']) === 'male' ? User::MALE : User::FEMALE;
        $rawPassword = str_random(10);

        if (!$account) {
            $account = User::create([
                'email' => $socialUser->email,
                'password' => bcrypt($rawPassword),
                'first_name' => $socialUser->name,
                'gender' => $gender,
                'active' => true,
            ]);
        }

        $account->social()->save($social);

        return $account;
    }

    /**
     * Where to redirect after login
     *
     * @return string
     */
    private function redirectPath()
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->currentRole()->isAdmin() ? route('admin.dashboard') : route('web.homepage');
    }

    /** @return string */
    private function loginPath()
    {
        return route('auth.getLogin');
    }

    /**
     * Login
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    private function login($user)
    {
        Auth::login($user);
        return redirect()->intended($this->redirectPath());
    }
}
