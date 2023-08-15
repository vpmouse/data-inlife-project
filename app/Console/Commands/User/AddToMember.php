<?php

namespace App\Console\Commands\User;

use App\Models\{Group, User};

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddToMember extends Command
{
    protected $signature = 'user:member';

    protected $description = 'Adds user to group and activate him if needed';

    public function handle(): int
    {
        $userId = (int) $this->ask('Enter user\'s id');
        $groupId = (int) $this->ask('Enter group\'s id');

        if (! $userId || ! $groupId) {
            $this->error('Не правильно указаны идентификаторы');
            return self::FAILURE;
        }

        DB::beginTransaction();
        try {
            $user = User::query()->find($userId);
            if (! $user || ! Group::query()->find($groupId)) {
                throw new \Exception('Пользователь или группа не найдены');
            }

            if ($user->groups->keyBy('id')->get($groupId)) {
                throw new \Exception('Пользователь уже добавлен в группу');
            }

            $user->groups()->attach($groupId);
            if (! $user->active && ! $user->update(['active' => true])) {
                throw new \Exception('Ошибка активации пользователя');
            }

            $this->info('Пользователь успешно добавлен в группу');
            DB::commit();
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            DB::rollBack();
            return self::FAILURE;
        }
    }
}
