<?php

namespace App\Domain\Users;

use Micbenner\ModelPresenter\Presentable;

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