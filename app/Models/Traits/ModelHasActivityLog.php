<?php

namespace App\Models\Traits;

trait ModelHasActivityLog
{
    public function activities()
    {
        return $this->morphMany('Spatie\Activitylog\Models\Activity', 'subject');
    }
}
