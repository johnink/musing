<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['name', 'full_name', 'short_desc','primary_tag','widget'];

    /**
	 * Get the tags associated with the given game.
	 */

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
