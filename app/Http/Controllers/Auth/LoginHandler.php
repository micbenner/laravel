<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Users\LoggedDataFetcher;
use App\Domain\Users\User;
use App\Http\Controllers\Controller;
use App\Http\Presenters\LoggedPresenter;
use App\Http\Presenters\LoggedShowPresenter;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Passport\ApiTokenCookieFactory;

class LoginHandler extends Controller
{
    use AuthenticatesUsers;

    private $cookieFactory;
    private $loggedDataFetcher;

    public function __construct(ApiTokenCookieFactory $cookieFactory, LoggedDataFetcher $loggedDataFetcher)
    {
        $this->cookieFactory     = $cookieFactory;
        $this->loggedDataFetcher = $loggedDataFetcher;
    }

    public function __invoke(Request $request)
    {
        return $this->login($request);
    }

    protected function authenticated(Request $request, User $user)
    {
        $response = new Response();

        $response->setContent(
            LoggedShowPresenter::flat($this->loggedDataFetcher->show($user))->toArray()
            + ['csrf' => $request->session()->token()]
        );

        $response->withCookie($this->cookieFactory->make(
            $request->user()->getKey(), $request->session()->token()
        ));

        return $response;
    }
}