<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Auth\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\ApiTokenCookieFactory;

class RegisterHandler extends LoginHandler
{
    public function __construct(ApiTokenCookieFactory $cookieFactory)
    {
        parent::__construct($cookieFactory);

        $this->middleware('guest');
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $this->create($request->all());

        return $this->login($request);
    }

    /**
     * @param array $data
     * @return \App\Domain\Auth\Models\User
     */
    protected function create(array $data): User
    {
        $user = User::create([
            'name'        => $data['name'],
            'email'       => $data['email'],
            'password'    => Hash::make($data['password']),
            'initialised' => false,
        ]);

        return $user;
    }
}