<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Website;

class WebsiteService
{
    public $domain;
    public $username;
    public $websiteIdentifier = null;
    public $current;

    public function __construct()
    {
        $this->domain = $this->getDomain();
        $this->username = $this->getUsername();
    }

    public function website($websiteIdentifier = null) : \App\Models\Website
    {
        if($this->current) {
            return $this->current;
        }

        if ($websiteIdentifier) {
            $this->current = $this->setCurrent($websiteIdentifier);
        } else {
            $this->current = $this->getCurrent();
        }

        return $this->current;
    }

    public function getCurrent()
    {
        if (app()->runningInConsole() && !$this->websiteIdentifier) {
            $this->websiteIdentifier = 1;
        }

        try {
            $expiresAt = now()->addMonths(1);
            $websiteIdentifier = $this->websiteIdentifier ?: $this->domain;
            $website = Cache::remember('Website.'. $websiteIdentifier, $expiresAt, function () {
                return $this->getWebsite();
            });
        } catch (\Exception $e) {
            info($e->getMessage());
            $website = $this->getWebsite();
        }

        if (!$website && ! app()->runningInConsole()){
            $this->websiteNotFound();
        }

        return $website;
    }

    private function getWebsite()
    {
        if ($this->websiteIdentifier && is_integer($this->websiteIdentifier)) {
            return Website::query()->find($this->websiteIdentifier);
        }

        return Website::query()
            ->where(function($query) {
                $query->where('domain', $this->websiteIdentifier ?: $this->domain)
                    ->orWhere('username', $this->websiteIdentifier ?: $this->username);
            })
            ->first();
    }

    private function getDomain(): string
    {
        return str_replace('www.', '', request()->getHost());
    }

    private function getUsername(): string
    {
        return current( explode('.', $this->domain) );
    }

    private function websiteNotFound(): void
    {
        abort(403, 'There is no website found for this domain');
    }
}
