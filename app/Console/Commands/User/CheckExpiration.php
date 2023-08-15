<?php

namespace App\Console\Commands\User;

use App\Jobs\DeactivateUsers;
use App\Mail\UserExcepted;
use App\Models\User;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

class CheckExpiration extends Command
{
    protected $signature = 'user:check_expiration';

    protected $description = 'Checks time expiration of being in group and deletes from group if time was expired.';

    public function handle(): int
    {
        $users = User::expired()->get();

        $users->each(function (User $user) {
            $groups = $user->groups()->where('expired_at', '<', Carbon::now());
            $groupNames = $groups->pluck('name');
            $groups->detach($groups->pluck('id'));

            $groupNames->each(function (string $groupName) use ($user) {
                Mail::to($user->email)->queue(new UserExcepted($user->name, $groupName));
            });
        });

        dispatch(new DeactivateUsers($users->pluck('id')->all()));
        return self::SUCCESS;
    }
}
