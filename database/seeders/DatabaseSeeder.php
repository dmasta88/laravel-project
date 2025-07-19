<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        //$user = User::factory(1)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $permissions = [
            [
                'title' => 'index',
            ],
            [
                'title' => 'create',
            ],
            [
                'title' => 'update'
            ],
            [
                'title' => 'show'
            ],
            ['title' => 'destroy']
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }

        $roles = [
            ['title' => 'admin'],
            ['title' => 'moderator_videos'],
            ['title' => 'moderator_posts']
        ];

        foreach ($roles as $role) {
            $role = Role::firstOrCreate($role);
            if ($role->title == 'moderator_videos') {
                $role->permissions()->sync([2, 3]);
            }
        }
        $user = User::firstOrCreate(['name' => "admin"], ['email' => 'tweens@inbox.ru', 'password' => Hash::make(123123)]);
        $user->roles()->sync([1, 2]);
        $user = User::firstOrCreate(['name' => "dmasta"], ['email' => 'dmasta88@yandex.ru', 'password' => Hash::make(321321)]);
        $user->roles()->sync([1, 2]);
        //$user->profile()->create();
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
