<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AuthorGroupSeeder::class,
            TermTypeSeeder::class,
            RoleSeeder::class,
        ]);

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@mail.ru';
        $user->phone = '+992 987 65 43 21';
        $user->role_id = 1;
        $user->password = bcrypt('12345');
        $user->email_verified_at = now();
        $user->save();

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@mail.ru';
        $user->role_id = 2;
        $user->password = bcrypt('12345');
        $user->email_verified_at = now();
        $user->save();
    }
}
