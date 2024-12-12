<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use RefreshDatabase;


    public function it_can_display_all_users()
    {
        // Arrange
        User::factory()->count(5)->create();

        // Act
        $response = $this->get(route('pengguna'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewHas('user');
    }


    public function it_can_store_a_new_user()
    {
        // Arrange
        $userData = [
            'username' => 'newuser',
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'role' => 'user',
            'password' => 'password123',
        ];

        // Act
        $response = $this->post(route('pengguna.store'), $userData);

        // Assert
        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'username' => 'newuser',
            'email' => 'newuser@example.com',
        ]);
    }


    public function it_can_update_an_existing_user()
    {
        // Arrange
        $user = User::factory()->create();
        $updatedData = [
            'data' => [
                'username' => 'updateduser',
                'name' => 'Updated User',
                'email' => 'updateduser@example.com',
                'role' => 'admin',
                'password' => 'newpassword123',
            ],
        ];

        // Encrypt ID for the request
        $encryptedId = Crypt::encrypt($user->id);
        $updatedData['id'] = $encryptedId;

        // Act
        $response = $this->patch(route('pengguna.edit', $user->id), $updatedData);

        // Assert
        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'username' => 'updateduser',
            'email' => 'updateduser@example.com',
            'role' => 'admin',
        ]);
    }


    public function it_can_delete_a_user()
    {
        // Arrange
        $user = User::factory()->create();

        // Encrypt ID for the request
        $encryptedId = Crypt::encrypt($user->id);

        // Act
        $response = $this->delete(route('pengguna.delete', $encryptedId));

        // Assert
        $response->assertRedirect();
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function it_should_fail_when_creating_user_with_existing_email()
    {
        // Arrange
        User::factory()->create(['email' => 'existinguser@example.com']);
        $userData = [
            'username' => 'newuser',
            'name' => 'New User',
            'email' => 'existinguser@example.com',
            'role' => 'user',
            'password' => 'password123',
        ];

        // Act
        $response = $this->post(route('pengguna.store'), $userData);

        // Assert
        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('users', 1);
    }
}
