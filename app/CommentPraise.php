<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentPraise extends Model
{
    protected $fillable = ['comment_id','user_id'];

    /**
	 * Get the comment associated with the given Praise.
	 */

    public function Comment()
    {
        return $this->belongsTo('App\Comment');
    }


}