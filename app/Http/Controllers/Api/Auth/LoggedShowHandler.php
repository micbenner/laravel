<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Bank\BankAccounts\BankAccountRepository;
use App\Domain\Groups\SplitGroupRepository;
use App\Domain\Users\LoggedDataFetcher;
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
    private $loggedDataFetcher;

    public function __construct(LoggedDataFetcher $loggedDataFetcher)
    {
        $this->loggedDataFetcher = $loggedDataFetcher;
    }

    public function __invoke(Request $request)
    {
        /** @var \App\Domain\Users\User $user */
        $user = $request->user('api');

        if (is_null($user)) {
            return ['user' => null];
        }

        return LoggedShowPresenter::flat($this->loggedDataFetcher->show($user));
    }
}