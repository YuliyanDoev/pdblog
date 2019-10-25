<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\v1\CommentResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text','user_id','article_id'];


    /**
     * The Resource used for transform data
     *
     * @var string
     */
    public $resource = CommentResource::class;

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
     * Get article user
     *
     * @return BelongsTo
     */
    public function article() : BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
