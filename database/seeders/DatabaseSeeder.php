<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DailyPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@mail.ru';
        $user->age = 26;
        $user->biography = 'Натуральный блондин, на всю страну такой один. И молодой и золотой и в добавок холостой...';
        $user->country_id = 1;
        $user->gender_id = 1;
        $user->role_id = 1;
        $user->password = bcrypt('12345');
        $user->email_verified_at = now();
        $user->save();

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@mail.ru';
        $user->age = 26;
        $user->biography = 'Натуральный блондин, на всю страну такой один. И молодой и золотой и в добавок холостой...';
        $user->country_id = 1;
        $user->gender_id = 1;
        $user->role_id = 3;
        $user->password = bcrypt('12345');
        $user->email_verified_at = now();
        $user->save();

        $this->call([
            CountrySeeder::class,
            GenderSeeder::class,
            AuthorGroupSeeder::class,
            TermTypeSeeder::class,
            RoleSeeder::class,
            FolderSeeder::class,
            FavoriteSeeder::class,
        ]);

        $post = new DailyPost();
        $post->date = now();
        $post->quote_id = '18';
        $post->term_id = '25';
        $post->video_id = '41';
        $post->photo_id = '20';
        $post->save();
    }
}
