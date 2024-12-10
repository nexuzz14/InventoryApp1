<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

    use RefreshDatabase;
    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    public function test_get_all_users()
    {
        User::factory()->count(3)->create(); // Menambahkan 3 user

        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    public function testStoreUser()
    {
        $userData = [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/users', $userData);
        $response->assertStatus(201);  // Pastikan responnya sesuai
    }

    public function test_update_user_with_password()
    {
        $user = User::factory()->create(['password' => bcrypt('oldpassword')]);
        $data = ['password' => 'newpassword'];

        $updated = $this->userService->updateUser($user->id, $data);

        $this->assertTrue($updated);
        $this->assertTrue(Hash::check('newpassword', $user->fresh()->password));
    }

    public function test_update_user_without_password()
    {
        $user = User::factory()->create();

        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            // Jangan sertakan password jika tidak diubah
        ];

        $response = $this->put("/users/{$user->id}", $updatedData);
        $response->assertStatus(200);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();
        $encryptedId = Crypt::encrypt($user->id);

        $deleted = $this->userService->deleteUser($encryptedId);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
