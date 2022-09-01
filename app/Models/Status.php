<?php

namespace App\Models;

use App\Models\Traits\CachesCount;

class Status extends \Spatie\ModelStatus\Status
{
    use CachesCount;
}
