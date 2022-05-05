<?php

namespace App\Helpers;

class AppHelper
{
    function websiteSegment($segment): ?string
    {
        //$baseSegmentCount = (int) settings('multiLanguages_enabled') + (!isInAdmin() ? (int) settings('multiCountries_enabled') : 0);
        //return request()->segment($baseSegmentCount + $segment);
        return request()->segment($segment);
    }

    function isInAdmin(): bool
    {
        //return request()->segment((int) settings('multiLanguages_enabled') + 1) == config('yallagroup.core.admin-prefix');
        return request()->segment(1) == config('core.admin-prefix');
    }
}
