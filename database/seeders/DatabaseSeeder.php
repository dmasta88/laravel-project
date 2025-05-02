<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::firstOrCreate(['name' => "admin"], ['email' => 'tweens@inbox.ru', 'password' => Hash::make(123123)]);
        //$user->profile()->create();
        Profile::firstOrCreate(['user_id' => $user->id], [
            'second_name' => 'Alex Admin',
            'third_name' => 'Andreevich',
            'avatar' => fake()->imageUrl(),
            'city' => fake()->city(),
            'login' => 'alex777',
        ]);
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            ChatSeeder::class,
            MessageSeeder::class,
        ]);
    }
}
