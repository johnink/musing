<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'doc_type','article_id','game_id','type','body','flux_date'];



   /**
	 * Get the user who wrote the comment.
	 */

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }


    /**
	 * Get the praises associated with the given comment.
	 */

    public function commentPraises()
    {
        return $this->hasMany('App\CommentPraise');
    }

     /**
	 * Get the flags associated with the given comment.
	 */

    public function commentFlags()
    {
        return $this->hasMany('App\CommentFlag');
    }
}