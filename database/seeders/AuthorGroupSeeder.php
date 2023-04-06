<?php

namespace Database\Seeders;

use App\Models\AuthorGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuthorGroup::insert([
            ['name' => AuthorGroup::PERSONS_GROUP_NAME],
            ['name' => AuthorGroup::MOVIES_GROUP_NAME],
            ['name' => AuthorGroup::PROVERBS_GROUP_NAME],
        ]);
    }
}
