<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Bank\BankAccounts\BankAccountRepository;
use App\Domain\Groups\SplitGroupRepository;
use App\Domain\Users\LoggedShower;
use App\Http\Controllers\Controller;
use App\Http\Presenters\BankAccountPresenter;
use App\Http\Presenters\LoggedPresenter;
use App\Http\Presenters\LoggedShowPresenter;
use App\Http\Presenters\SplitGroupPresenter;
use App\Http\Presenters\UserPresenter;
use App\Users\Logged;
use Illuminate\Http\Request;

class LoggedShowHandler extends Controller
{
    public function __invoke(Request $request)
    {
        /** @var \App\Domain\Auth\Models\User $user */
        $user = $request->user('api');

        if (is_null($user)) {
            return ['user' => null];
        }

        return LoggedShowPresenter::flat($user);
    }
}