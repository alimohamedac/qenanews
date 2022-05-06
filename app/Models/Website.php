<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;
use App\Models\Traits\HasExtraAttributes;
use App\Models\Traits\ModelHasActivityLog;
use App\Models\Traits\ModelHasDates;
use App\Models\Traits\ModelHasThumbnails;

/**
 * @property integer id
 * @property integer|null owner_id
 * @property string|null title
 * @property string|null description
 * @property string|null keywords
 * @property string|null username
 * @property integer|null phoneNumber
 * @property string|null logo
 * @property string|null cover
 * @property string|null watermark
 * @property string schema
 * @property string|null domain
 * @property string theme
 * @property string color
 * @property string default_locale
 * @property string default_country
 * @property integer visits
 * @property integer|null country_id
 * @property integer|null province_id
 * @property integer|null division_id
 * @property integer|null area_id
 * @property string|null address
 * @property string|null google_map_url
 * @property string|null webmasterMail
 * @property string|null facebookUrl
 * @property string|null twitterUrl
 * @property string|null instagramUrl
 * @property string|null whatsappUrl
 * @property string|null telegramUrl
 * @property string|null snapchatUrl
 * @property string|null soundcloudUrl
 * @property string|null youtubeUrl
 * @property array|null extra_attributes
 * @property string|null note
 * @property integer|null created_by
 * @property Carbon|null published_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon|null deleted_at
 *
 * [dynamic attributes]
 * @property string url
 * @property string admin_url
 *
 * */
class Website extends Model
{
    use ModelHasThumbnails,
        Translatable,
        ModelHasDates,
        HasExtraAttributes,
        ModelHasActivityLog;

    // Eager loading all the registered attributes
    protected $with = ['translations'];

    public $translatedAttributes = ['title', 'description'];
    public $translationForeignKey = 'website_id';
    public $useTranslationFallback = true;
    protected $guarded = ['id'];
    protected $table = 'websites';
    protected $allThumbnails = [
        'logo',
        'cover',
        'watermark',
    ];
    //=> The attributes that should be mutated to dates
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_at',
    ];

    public $casts = [
        'extra_attributes'          => 'array',
    ];

    public function getUrlAttribute(): string
    {
        return Cache::rememberForever($this->getTable() . '.url.' . $this->getKey(), function () {
            return $this->url();
        });
    }

    public function getAdminUrlAttribute(): string
    {
        return Cache::rememberForever($this->getTable() . '.admin_url.' . $this->getKey(), function () {
            return $this->adminUrl();
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function url($after = null, $language = null, $country = null): string
    {
        //=> fix repeat or missing slash (/)
        $after = ($after != null && substr($after, 0, 1) != '/') ? ('/' . $after) : $after;

        return $this->schema . '://' . $this->domain . $language . $country . $after;
    }

    public function adminUrl($after = null, $language = null): string
    {
        $before = '/' . config('core.admin-prefix');

        //=> fix repeat or missing slash (/)
        $after = ($after != null && substr($after, 0, 1) != '/') ? ('/' . $after) : $after;

        return $this->schema . '://' . $this->domain . $language . $before . $after;
    }

    public function logo($thumbnail = 'mini'): ?string
    {
        return $this->withoutNoPhoto($this->thumbnail('logo', $thumbnail)) ?? (config('yallagroup.websites.options.custom_logo_enabled') ? asset('images/logo.png') : null);
    }

    public function cover($thumbnail = 'cover'): ?string
    {
        return $this->withoutNoPhoto($this->thumbnail('cover', $thumbnail)) ?? asset('images/cover.jpg');
    }

    public function watermark($thumbnail = 'original'): ?string
    {
        //=> must be original, no thumbnails, to avoid code-loop error in resize function that use website()->watermark()
        return $this->withoutNoPhoto($this->thumbnail('watermark', 'original'));
    }

    public function ogImage(): ?string
    {
        return $this->cover() ?? ($this->logo() ?? asset('images/og-image.png'));
    }

}
