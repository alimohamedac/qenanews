<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Scopes\HasEagerLoadedAttributes;
use App\Models\Scopes\MainSelectAttributes;

class HomeController extends Controller
{
    public $paginationNum = 20;

    public function index()
    {
        //latest
        $items = News::query()
            ->withoutGlobalScopes([MainSelectAttributes::class, HasEagerLoadedAttributes::class])  //=> because some attribute don't appear like media_url
            ->with(['translations:title,description,news_id,locale'])
            ->paginate($this->paginationNum);

        return view('blog.home', compact('items'));
    }

}
