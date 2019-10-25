<?php

namespace App\Models;

use App\User;
use App\Models\Tag;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\v1\ArticleResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description','user_id','image','category_id'];

     /**
     * The Resource used for transform data
     *
     * @var string
     */
    public $resource = ArticleResource::class;

    /**
     * Get article category
     *
     * @return BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get article user
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get article tags
     *
     * @return BelongsTo
     */
    public function tags() : BelongsToMany
    {
        return $this->BelongsToMany(Tag::class,'article_tag_mappings');
    }

     /**
     * Get article comments
     *
     * @return HasMany
     */
    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }


    public function scopeSearch(Builder $query,$search,$category,$tag) : Builder {

        if($search){
            $query->where('title','like',"%$search%");
        }

        if($category){
            $query->where('category_id',$category);
        }

        if($tag){

            $query->whereHas('tags',function($query) use($tag){
                $query->where('id',$tag);
            });
        }

        return $query;
    }
}
