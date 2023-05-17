<?php

namespace Database\Seeders;

use App\Models\Folder;
use App\Models\User;
use App\Support\Helpers\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            $user->folders()->saveMany([
                new Folder(['name' => 'Основная папка', 'slug' => Helper::generateSlug('Основная папка')]),
                new Folder(['name' => 'Разное', 'slug' => Helper::generateSlug('Разное')]),
            ]);
        });
    }
}
