<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route('pengguna'));
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.pengguna');
    }

    public function test_store_user()
    {
        $data = [
            'username' => 'testuser',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user',
            'password' => 'password123',
        ];

        $response = $this->post(route('pengguna.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'username' => 'testuser',
            'email' => 'test@example.com',
        ]);
    }

    public function test_update_user()
    {
        $user = User::factory()->create();

        $data = [
            'id' => Crypt::encrypt($user->id),
            'data' => [
                'username' => 'updateduser',
                'name' => 'Updated User',
                'email' => 'updated@example.com',
                'role' => 'admin',
            ],
        ];

        $response = $this->patch(route('pengguna.edit', ['id' => Crypt::encrypt($user->id)]), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'username' => 'updateduser',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_destroy_user()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('pengguna.delete', ['id' => Crypt::encrypt($user->id)]));

        $response->assertRedirect();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
