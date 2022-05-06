<?php

namespace App\Models\Traits;

trait ModelHasDates
{
    public function created_at($format='d F Y'): ?string
    {
        return $this->created_at->translatedFormat($format);
    }

    public function updated_at($format='d F Y'): ?string
    {
        return $this->updated_at->translatedFormat($format);
    }

    public function published_at($format='d F Y', $type = 'gregorian'): ?string
    {
        $date = $this->published_at->translatedFormat($format);

        if($type == 'hijri') {
            $date = $this->published_at('l').' '.YG_LocalizedDate($this->published_at, false, 'd M Y', 'hijri').' - '.$this->published_at('H:i a');
        }

        if (config('core.useArabicDate') && currentLocale() == 'ar') {
            return enNumbersToAr($date);
        }

        return $date;
    }
}
