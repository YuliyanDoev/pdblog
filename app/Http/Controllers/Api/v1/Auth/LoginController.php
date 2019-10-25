<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Traits\AuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\LoginUser;
use App\Http\Requests\v1\RefreshToken;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    use AuthTrait;

    /**
     * Get Passport client secret key and id
     *
     * @var Laravel\Passport\Client
     */

    private $client;

    public function __construct()
    {
        $this->client = Client::where('name','like','% '.config('auth.password_client_id'))->first();
    }

    /**
     * Login user and return access token
     *
     * @param LoginUser $request
     * @return void
     */

    public function login(LoginUser $request){

        return $this->issueToken($request,$this->client,'password','*');
    }


    /**
     * Refresh user token by refresh token in request
     *
     * @param Request $request
     * @return void
     */
    public function refresh(RefreshToken $request){

        return $this->issueToken($request,$this->client,'refresh_token');
    }

    /**
     * Logout user and make his tokens revoked
     *
     * @return void
     */
    public function logout(){
        $accessToken  = auth()->user()->token();

        DB::table('oauth_refresh_tokens')->where('access_token_id',$accessToken->id)->update(['revoked'=> true]);

        $accessToken->revoke();

        return $this->deleteResponse();
    }

    /**
     * Get user data
     *
     * @return void
     */
    public function show(){
        $user = auth()->user();
        return $this->successResponse(['userRole'=>$user->roles->first()->name]);
    }

}
