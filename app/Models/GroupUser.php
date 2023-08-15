<?php

namespace App\Models;

use App\Events\User\CreatedEvent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

use Laravel\Sanctum\HasApiTokens;

/**
 * @property string|null $user_id
 * @property string|null $group_id
 * @property string|null $expired_at
 */
class GroupUser extends Pivot
{
    use HasApiTokens;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_id',
        'expired_at',
    ];

    protected $dispatchesEvents = [
        'created' => CreatedEvent::class,
    ];
}
