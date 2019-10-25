<?php

namespace App\Models;

use App\Http\Resources\v1\TagResource;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

     /**
     * The Resource used for transform data
     *
     * @var string
     */
    public $resource = TagResource::class;

      /**
     * Get tag articles
     *
     * @return BelongsTo
     */
    public function articles() : HasMany
    {
        return $this->hasMany(Article::class);
    }
}
