<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string|null $id
 * @property string|null $name
 * @property int|null $expire_hours
 */
class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'expire_hours',
    ];

    public $timestamps = false;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(GroupUser::class);
    }
}
