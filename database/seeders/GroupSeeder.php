<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $groupFields = [
            [
                'name' => 'Группа1',
                'expire_hours' => 1
            ],
            [
                'name' => 'Группа2',
                'expire_hours' => 2
            ],
        ];

        Group::query()->insert($groupFields);
    }
}
