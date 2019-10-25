<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\User;
use App\Traits\AuthTrait;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\v1\RegisterUser;

class RegisterController extends Controller
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
     * Create user and access token
     *
     *
     * @param RegisterUser $request
     * @return void
     */
    public function register(RegisterUser $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ];

        $user = User::create($data);
        $user->assignRole('User');

        return $this->issueToken($request,$this->client);
    }
}
