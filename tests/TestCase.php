<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user = null;
    protected $token = null;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed', ['--class' => 'RoleSeeder']);

        $roles = \App\Models\Role::get()->pluck('id')->toArray();
        $clientRepository = new \Laravel\Passport\ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', 'http://localhost'
        );

        \DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->user = \App\Models\User::factory()->create();
        $this->user->roles()->attach($roles);
        $this->token = $this->user->createToken('TestToken')->accessToken;
    }
}
