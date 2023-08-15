<?php

namespace App\Events\User;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MutatedEvent
{
    use Dispatchable;
    use SerializesModels;
}
