<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\Auth\Response;
use App\Http\Controllers\Controller;
use App\Http\Presenters\LoggedPresenter;
use http\Env\Request;
use Laravel\Passport\ApiTokenCookieFactory;

class LocalLoginHandler extends Controller
{
    private $cookieFactory;

    public function __construct(ApiTokenCookieFactory $cookieFactory)
    {
        $this->cookieFactory = $cookieFactory;
    }

    public function __invoke(Request $request, int $id)
    {
        $user = \Auth::onceUsingId($id);

        $response = new Response();
        $response->setContent(LoggedPresenter::make($user)->toArray() + ['csrf' => $request->session()->token()]);

        $response->withCookie($this->cookieFactory->make(
            $request->user()->getKey(), $request->session()->token()
        ));

        return $response;
    }
}