<?php

namespace App\Traits;

use App\User;
use App\PasswordReset;
use App\Notifications\TwoFactorAuth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

/**
 * Auth Helpers Trait
 */
trait AuthTrait
{


    /**
     * Create a in app request and get token for user
     *
     * @param Illuminate\Support\Facades\Request $request
     * @param Laravel\Passport\Client $client
     * @param string $grantType
     * @param string $scope
     * @return object response
     */
    protected function issueToken($request,$client, $grantType = 'password', $scope = '*') {

        $params = [
            'grant_type' => $grantType,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'scope' => $scope,
        ];

        if($grantType == 'refresh_token'){
            $params['refresh_token'] =$request->get('refresh_token');
        }else{
            $params['username'] = $request->get('email');
            $params['password'] = $request->get('password');
        }

        $proxy = Request::create('oauth/token', 'POST');

        $proxy->request->add($params);

        return app()->handle($proxy);

    }


    public function createResetPasswordToken($email)
    {
        PasswordReset::where('email', $email)->delete();
        return PasswordReset::create(['email' => $email, 'token' => str_random(60)]);
    }

}
