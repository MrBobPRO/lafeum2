<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Quote;
use App\Models\Term;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::all()->each(function ($user) {
        //     $user->favorites()->saveMany([
        //         new Favorite(['favoritable_id' => '3851', 'favoritable_type' => Quote::class, 'folder_id' => $user->folders()->first()->id]),
        //         new Favorite(['favoritable_id' => '3847', 'favoritable_type' => Quote::class, 'folder_id' => $user->folders()->first()->id]),

        //         new Favorite(['favoritable_id' => '1269', 'favoritable_type' => Term::class, 'folder_id' => $user->folders()->skip(1)->first()->id]),
        //         new Favorite(['favoritable_id' => '1268', 'favoritable_type' => Term::class, 'folder_id' => $user->folders()->skip(1)->first()->id]),
        //         new Favorite(['favoritable_id' => '1207', 'favoritable_type' => Video::class, 'folder_id' => $user->folders()->skip(1)->first()->id]),
        //     ]);
        // });
    }
}
