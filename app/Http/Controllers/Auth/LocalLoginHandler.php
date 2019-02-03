<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Users\User;
use App\Http\Controllers\Controller;
use App\Http\Presenters\LoggedPresenter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        if (!$user) {
            return 'User not found';
        }

        $response = new Response();
        $response->setContent(LoggedPresenter::make($user)->toArray() + ['csrf' => $request->session()->token()]);

        $response->withCookie($this->cookieFactory->make(
            $request->user()->getKey(), $request->session()->token()
        ));

        return $response;
    }
}