<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentFlag extends Model
{
    protected $fillable = ['comment_id','user_id','message'];

    /**
	 * Get the comment associated with the given Flag.
	 */

    public function Comment()
    {
        return $this->belongsTo('App\Comment');
    }


}