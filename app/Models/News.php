<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasExtraAttributes;
/*use Modules\Core\Entities\Traits\TaggableTrait;
use Modules\Taxonomies\Contracts\TaxonomizableContract;
use Modules\Taxonomies\Traits\TaxonomizableTrait;*/

class News extends Model implements TaggableInterface, TaxonomizableContract
{
    use Translatable,
        TaggableTrait,
        TaxonomizableTrait,
        HasExtraAttributes;

    protected $table = 'news';
    protected $guarded = ['id'];

    protected $casts = [
        'showInHomePage'    => 'boolean',
        'is_pinned'         => 'boolean',
        'is_special'        => 'boolean',
        'allowComments'     => 'boolean',
        'isProtected'       => 'boolean',
    ];

    function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
