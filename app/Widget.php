<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = ['game_id','user_id','widget_num','game_options'];

    /**
	 * Get the game associated with the given Widget.
	 */

    public function game()
    {
        return $this->hasOne('App\Game','id','game_id');
    }
}
