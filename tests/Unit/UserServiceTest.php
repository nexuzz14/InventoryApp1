<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    protected $userService;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = app(UserService::class);
    }

    public function test_store_user()
{
    $data = [
        'name' => 'Test User',
        'username' => 'uniqueuser', // Ensure 'username' is provided
        'email' => 'testuser@example.com',
        'role' => 'user',
        'password' => 'password123',
    ];

    $userService = new UserService();
    $user = $userService->storeUser($data);

    $this->assertDatabaseHas('users', [
        'username' => $data['username'],
        'email' => $data['email'],
    ]);
}

public function test_update_user()
{
    $user = User::factory()->create([
        'username' => 'olduser',
        'email' => 'olduser@example.com',
    ]);

    $data = [
        'name' => 'Updated User',
        'username' => 'updateduser', // Ensure the new username is provided
        'email' => 'newemail@example.com',
        'role' => 'admin',
    ];

    $userService = new UserService();
    $updatedUser = $userService->updateUser($user->id, $data);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'username' => $data['username'], // Validate 'username' update
        'email' => $data['email'],
    ]);
}
    public function test_delete_user()
    {
        $user = User::factory()->create([
            'username' => 'deletableuser',
            'email' => 'deletable@example.com',
            'role' => 'user',
        ]);

        $userService = new UserService();
        $result = $userService->deleteUser(Crypt::encrypt($user->id));

        $this->assertTrue($result);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
