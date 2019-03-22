<?php

namespace App\Domain\Users;

use App\Presentation\Presentable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements Presentable
{
    use HasApiTokens, Notifiable;

    protected $guarded = [];

    protected $visible = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }
}
