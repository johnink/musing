<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['name'];

    /**
	 * Get the games associated with the given tag.
	 */

    public function games()
    {
        return $this->belongsToMany('App\Game')->withTimestamps();
    }

    public function articles()
    {
        return $this->belongsToMany('App\Game')->withTimestamps();
    }
}
