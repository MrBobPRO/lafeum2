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
        $user = User::find(1);
        $user->folders()->saveMany([
            new Folder(['name' => 'Цитаты']),
            new Folder(['name' => 'Термины']),
            new Folder(['name' => 'Видео']),
        ]);

        $user = User::find(2);
        $user->folders()->saveMany([
            new Folder(['name' => 'Мои любимые']),
            new Folder(['name' => 'Цитаты', 'parent_id' => 4]),
            new Folder(['name' => 'Термины', 'parent_id' => 4]),
            new Folder(['name' => 'Видео', 'parent_id' => 4]),
            new Folder(['name' => 'Для записей']),
            new Folder(['name' => 'Посмотреть позже']),
        ]);
    }
}
