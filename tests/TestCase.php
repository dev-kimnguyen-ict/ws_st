<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const USER = User::USER;
    const ADMIN = User::ADMIN;

    protected function setAuth($role, $authInformation = [])
    {
        $authInformation = array_merge($authInformation, ['role_id' => $role]);
        $auth = factory(User::class)->create($authInformation);
        $this->actingAs($auth);
    }
}
