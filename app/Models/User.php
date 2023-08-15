<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Laravel\Sanctum\HasApiTokens;

/**
 * @property string|null $id
 * @property string|null $name
 * @property string|null $email
 * @property boolean|null $active
 */
class User extends Model
{
    use HasApiTokens;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'active',
    ];

    public $timestamps = false;

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class)->using(GroupUser::class);
    }

    public function scopeExpired(Builder $q):void
    {
        $q->whereHas('groups', function ($query) {
            $query->where('expired_at', '<', Carbon::now());
        });
    }
}
