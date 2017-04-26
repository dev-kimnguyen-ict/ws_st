<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const USER = User::USER;
    const ADMIN = User::ADMIN;

    protected function setAuth($role, $data = [])
    {
        $data = array_merge($data, ['role_id' => $role]);
        $auth = factory(User::class)->create($data);
        $this->actingAs($auth);
    }
}
