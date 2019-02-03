<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Presenters\LoggedPresenter;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Passport\ApiTokenCookieFactory;

class LoginHandler extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var \Laravel\Passport\ApiTokenCookieFactory
     */
    private $cookieFactory;

    public function __construct(ApiTokenCookieFactory $cookieFactory)
    {
        $this->cookieFactory = $cookieFactory;
    }

    public function __invoke(Request $request)
    {
        return $this->login($request);
    }

    protected function authenticated(Request $request, User $user)
    {
        $response = new Response();

        $response->setContent(
            LoggedPresenter::flat($user)->toArray()
            + ['csrf' => $request->session()->token()]
        );

        $response->withCookie($this->cookieFactory->make(
            $request->user()->getKey(), $request->session()->token()
        ));

        return $response;
    }
}