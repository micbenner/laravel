<?php

namespace Tests\Feature;

use App\Domain\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureTestCase extends TestCase
{
    use RefreshDatabase;

    public function login($driver = null)
    {
        factory(User::class)->create([

        ]);

        $this->be(User::first(), $driver);
    }
}