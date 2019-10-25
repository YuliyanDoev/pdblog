<?php

namespace App\Models;

use App\Http\Resources\v1\CategoryResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
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
    public $resource = CategoryResource::class;

    /**
     * Get category articles
     *
     * @return BelongsTo
     */
    public function articles() : HasMany
    {
        return $this->hasMany(Article::class);
    }
}
