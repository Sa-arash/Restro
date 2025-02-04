<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'SamJad',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
        ]);
        DB::table('model_has_roles')->insert([
            ['role_id' => 1, 'model_type' => 'App\\Models\\User', 'model_id' => 1],
        ]);
    }
}
