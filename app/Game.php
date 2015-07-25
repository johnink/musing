<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['name', 'full_name', 'short_desc','what_youll_need','long_desc','writing','blogging','socialmedia','stageimprov','drawing','standup','music','widget'];

    /*public function widget()
    {
        return $this->hasMany('App\Widget');
    }*/
}
