<?php

namespace App\Models\Traits;

trait ModelHasThumbnails
{
    use HasThumbnails;

    public function image($thumbnail = 'medium'): ?string
    {
        $photo = $this->thumbnail('photo', $thumbnail);
        if (config('yallagroup.topics.options.without-no-photo')) {
            return $this->withoutNoPhoto($photo);
        }

        return $photo;
    }

    public function logo($thumbnail = 'mini'): ?string
    {
        return $this->withoutNoPhoto($this->thumbnail('logo', $thumbnail));
    }

    public function cover($thumbnail = 'cover'): ?string
    {
        return $this->withoutNoPhoto($this->thumbnail('cover', $thumbnail)) ?? website()->cover();
    }

    //=> photo
    public function getImageOriginalAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.image_original.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->image('original');
        });
    }

    public function getImageCoverAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.image_cover.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->image('cover');
        });
    }

    public function getImageBigAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.image_big.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->image('big');
        });
    }

    public function getImageMediumAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.image_medium.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->image('medium');
        });
    }

    public function getImageMiniAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.image_mini.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->image('mini');
        });
    }

    //=> logo
    public function getLogoOriginalAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.logo_original.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->logo('original');
        });
    }

    public function getLogoMediumAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.logo_medium.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->logo('medium');
        });
    }

    public function getLogoMiniAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.logo_mini.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->logo('mini');
        });
    }

    //=> cover
    public function getCoverOriginalAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.cover_original.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->cover('original');
        });
    }
    public function getCoverCoverAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.cover_cover.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {
            return $this->cover('cover');
        });
    }

    //=> ogImage
    public function getOgImageAttribute(): ?string
    {
        return cache()->rememberForever($this->getTable() .'.og_image.'. $this->getKey() .'.'. ($this->website_id ?? website()->id), function () {

            if (method_exists($this, 'ogImage')) {
                return $this->ogImage();
            }

            return $this->image('big');
        });
    }
}
