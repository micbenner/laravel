<?php

namespace App\Domain\Users;

class LoggedDataFetcher
{
    public function show(User $user): LoggedShowData
    {
        return new LoggedShowData($user);
    }
}