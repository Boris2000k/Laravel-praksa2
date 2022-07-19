<?php

namespace App;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    // blog_post_id
    use SoftDeletes;
    public function blogPost()
    {
        // return $this->belongsTo('App\BlogPost', 'post_id', 'blog_post_id');
        return $this->belongsTo('App\BlogPost');

    }

    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new LatestScope);

    }
}
