<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\administrator;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'username' => 'asads',
            'email' => 'test@example.com',
            'password'=>'asdasdasd'
        ]);

        // User::factory()->create([
        //     'username' => 'asads',
        //     'email' => 'test@example.com',
        //     'password'=>'asdasdasd'
        // ]);

        // administrator::factory()->create([
        //     'username' => "suminto",
        //     "password" => "asdasdasd",
        //     "level" => "admin",
        // ]);
        User::factory(1)->create();
    }
}
