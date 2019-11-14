<?php

namespace Tests\Feature;

use App\User;
use App\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class BackOfficeAuthTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function testUnauthorizedDashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302);
    }

    public function testAdminAccessGet()
    {
        $admin = factory(User::class)->make();
        $admin->{'role-id'} = 2;
        $this->actingAs($admin);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $response = $this->get(route('client.index'));
        $response->assertStatus(200);

        $test_client = Client::all()->first();
        $response = $this->get(route('client.edit', ['client' => $test_client->id]));
        $response->assertStatus(200);

        $response = $this->get(route('user.index'));
        $response->assertStatus(200);

        $test_user = User::all()->first();
        $response = $this->get(route('user.edit', ['user' => $test_user->id]));
        $response->assertStatus(200);

        $response = $this->get('/create-user');
        $response->assertStatus(200);
    }

    public function testUserAccessGet()
    {
        $user = factory(User::class)->make();
        $user->{'role-id'} = 1;
        $this->actingAs($user);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $response = $this->get(route('client.index'));
        $response->assertStatus(200);

        $test_client = Client::all()->first();
        $response = $this->get(route('client.edit', ['client' => $test_client->id]));
        $response->assertStatus(200);

        $response = $this->get(route('user.index'));
        $response->assertStatus(403);

        $test_user = User::all()->first();
        $response = $this->get(route('user.edit', ['user' => $test_user->id]));
        $response->assertStatus(403);

        $response = $this->get('/create-user');
        $response->assertStatus(403);
    }

    public function testUserUpdate()
    {
        $this->withoutMiddleware();

        $admin = factory(User::class)->make();
        $admin->{'role-id'} = 2;
        $this->actingAs($admin);

        $user = factory(User::class)->make();
        $user->save();
        $test_email = $user->email . 'm';
        $response = $this->put(route('user.update', ['user' => $user->id ]),
            ['email' => $test_email, 'role-id' => $user->{'role-id'}]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('user.index'));
        $this->assertDatabaseHas('users', ['id' => $user->id, 'email' => $test_email]);
    }

    public function testClientUpdate()
    {
        $this->withoutMiddleware();

        $admin = factory(User::class)->make();
        $admin->{'role-id'} = 2;
        $this->actingAs($admin);

        $client = factory(Client::class)->make();
        $client->save();

        $test_name = Str::random(10);
        $params = [
            'name'          => $test_name,
            'surname'       => $client->surname,
            'date-of-birth' => $client->{'date-of-birth'},
            'email'         => $client->email,
            'country'       => $client->country,
            'address'       => $client->arrdess,
        ];

        $response = $this->put(route('client.update', ['client' => $client->id ]), $params);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('clients', ['id' => $client->id, 'name' => $test_name]);

        $response->assertRedirect(route('client.index'));

        Client::where(['id' => $client->id])->delete();
    }

}
