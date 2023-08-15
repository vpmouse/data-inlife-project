<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};

class DeactivateUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected array $userIds) {}

    public function handle(): void
    {
        $success = (bool)User::query()->whereIn('id', $this->userIds)->update(['active' => false]);
        if (! $success) {
            $this->fail();
        }
    }
}
