<?php

use App\Models\Setting;

function websiteSegment($segment): ?string
{
    return request()->segment($segment);
}

function isInAdmin(): bool
{
    //return request()->segment(1) == config('core.admin-prefix');
    return request()->segment(1) == config('core.admin-prefix');
}

function getSetting($key, $local)
{
    if( $setting = Setting::where('local', $local)->where('key', $key)->first() ){
        return $setting->value;
    }
    return null;
}

function website($websiteIdentifier = null) : \App\Models\Website
{
    return app(\App\Services\WebsiteService::class)->website($websiteIdentifier);
}
