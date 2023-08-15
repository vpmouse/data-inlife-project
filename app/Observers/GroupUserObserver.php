<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\GroupUser;
use Carbon\Carbon;

class GroupUserObserver
{
    public function created(GroupUser $groupUser): void
    {
        /** @var Group $group */
        $group = Group::query()->where('id', $groupUser->group_id)->first();
        $expiredAt = Carbon::now()->addHours($group->expire_hours);

        $success = $groupUser->update(['expired_at' => $expiredAt]);
        if (! $success) {
            throw new \Exception('Failed to updated expiration time');
        }
    }
}
