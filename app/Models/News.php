<?php

namespace App\Models;

use App\Models\Scopes\HasEagerLoadedAttributes;
use App\Models\Scopes\MainSelectAttributes;
use App\Helpers\AppHelper;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasExtraAttributes;
use App\Contracts\TaxonomizableContract;
use App\Models\Traits\TaxonomizableTrait;

class News extends Model implements TaxonomizableContract
{
    use Translatable,
        TaxonomizableTrait,
        HasExtraAttributes;

    protected $table = 'news';
    protected $guarded = ['id'];

    //protected static $tagsModel = 'Cartalyst\Tags\IlluminateTag';
    public $translatedAttributes = ['title', 'tiny_title', 'summary', 'description'];
    public $translationForeignKey = 'news_id';
    public $useTranslationFallback = true;

    public static $eagerLoadedAttributes = ['translations:title,news_id,locale'];
    public static $mainSelectAttributes  = ['news.id', 'news.user_id', 'news.author', 'news.slug', 'news.type', 'news.photo','news.visits','news.created_at','news.published_at', 'news.is_pinned', 'news.is_special', 'news.province_id', 'news.division_id'];

    //=> The attributes that should be mutated to dates
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_at'
    ];

    protected $casts = [
        'showInHomePage'    => 'boolean',
        'is_pinned'         => 'boolean',
        'is_special'        => 'boolean',
        'allowComments'     => 'boolean',
        'isProtected'       => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        if (! isInAdmin()) {
            static::addGlobalScope(new MainSelectAttributes());
        }

        //static::addGlobalScope(new WherePublished());

        if (! isInAdmin()) {
            static::addGlobalScope(new HasEagerLoadedAttributes());
           // static::addGlobalScope(new WhereCountry());

            //=> translatedInCurrentLocalOnly
            /*if (! app()->runningInConsole() && config('yallagroup.topics.options.translatedInCurrentLocalOnly') && count(website()->enabled_content_locales) > 1 ) {
                static::addGlobalScope('currentLocalOnly', function (Builder $builder) {
                    $builder->whereHas('translations',function($query){
                        $query->where('topic_translations.locale', currentLocale())
                            ->where('topic_translations.title', '!=', null);
                    });
                });
            }*/
        }
    }

    function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function activities()
    {
        return $this->morphMany('Spatie\Activitylog\Models\Activity', 'subject');

    }

    public function icon(): string
    {
        if ($this->type === 'video'){
            return 'fas fa-video';
        }elseif($this->type === 'audio'){
            return 'fas fa-microphone-alt';
        }

        return 'fas fa-file-alt';
    }
}
