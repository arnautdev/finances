<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * @var bool
     */
    public $checkAuth = false;


    /**
     * @param $service
     */
    public function redirect($service)
    {
        // override default redirect
        $this->overrideRedirectUri($service);

        // redirect to social-network
        return Socialite::driver($service)->redirect();
    }


    /**
     * @param $service
     */
    public function callback($service)
    {
        $redirectUrl = route('dashboard');
        try {
            // override default redirect
            $this->overrideRedirectUri($service);

            $user = Socialite::driver($service)->user();
            $data['socialId'] = $user->getId();
            $data['socialSource'] = ucfirst($service);
            $dbUser = User::where('email', '=', $user->getEmail())->first();
            if ($dbUser->exists()) {
                $dbUser->update($data);
                if (auth()->loginUsingId($dbUser->id)) {
                    return redirect($redirectUrl)->with('success', __('Welcome back :name', ['name' => $dbUser->name]));
                }
            } else {
                // else create new user
                $data['name'] = $user->getName();
                $data['email'] = $user->getEmail();
                $data['userPersonalDataAgreement'] = 'yes';

                $randPassword = str_random(10);
                $data['randPassword'] = $randPassword;
                $data['password'] = Hash::make($randPassword);
                $createdUser = (new User())->create($data);
                if (auth()->loginUsingId($createdUser->id)) {
                    return redirect($redirectUrl)->with('success', __('Welcome back :name', ['name' => $createdUser->name]));
                }
            }

            return back()->with('error', __('Something wrong :name', ['name' => $dbUser->name]));
        } catch (\Exception $e) {
            return back()->with('error', __('Something wrong :error', ['error' => $e->getMessage()]));
        }
    }


    /**
     * @param $service
     */
    private function overrideRedirectUri($service)
    {
        $redirect = 'https://' . request()->getHost() . '/auth/' . $service . '/callback';
        config([
            'services.' . $service . '.redirect' => $redirect,
            'services.' . $service . '.redirect_uri' => $redirect
        ]);
    }
}
