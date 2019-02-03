<?php

namespace App\Domain\Users;

use App\Presentation\Presentable;

class LoggedShowData implements Presentable
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}