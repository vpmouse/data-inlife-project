<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $userFields = [
            [
                'name' => 'Иванов',
                'email' => 'info@datainlife.ru'
            ],
            [
                'name' => 'Петров',
                'email' => 'job@datainlife.ru'
            ],
        ];

        User::query()->insert($userFields);
    }
}
