<?php

namespace App\Models\Traits;

use Modules\Core\Services\Facades\Attachments;

trait HasThumbnails
{
    public function thumbnail($attribute, $thumbnail='original'): string
    {
        return Attachments::getThumbnail($this->{$attribute}, $thumbnail);
    }

    public function withoutNoPhoto($thumbnail): ?string
    {
        if(! isset($thumbnail) || strpos($thumbnail, 'nophoto.png') !== false){
            return null;
        }

        return $thumbnail;
    }
}
