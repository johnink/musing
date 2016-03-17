<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CreateArticle;

class Article extends Model
{
    protected $fillable = [
        'category',
    	'title',
    	'body',
        'draft',
    	'excerpt',
        'description',
    	'published_at'
    ];

    protected $dates = ['published_at'];

    public function scopePublished($query){
        if(Auth::guest()||Auth::user()->name!='Admin'){
    	   $query->where('published_at','<=',Carbon::now())->where('draft','false');
        }
    }

    public function setPublishedAtAttribute($date){
    	$this->attributes['published_at']=Carbon::parse($date);
    }

    public function getPublishedAtAttribute($date){

        return new Carbon($date);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    //use $article->tag_list to pull a list of tag ids
    //used in _form.blade.php for articles

    public function getTagListAttribute(){
        return $this->tags->lists('id')->all();
    }

    //assigns the full category to each of the articles
    public function assignFullCategory(){

        
        switch($this->category){
            case "things":
                $this->full_category="Things to Consider";
            break;
            case "guest":
                $this->full_category="Guest Article";
            break;
            case "blog":
                $this->full_category="Blog";
            break;
            case "game":
                $this->full_category="New Game";
            break;
            case "recommendation":
                $this->full_category="Review";
            break;
            case "spotlight":
                $this->full_category="Spotlight";
            break;
            default:
                $this->full_category="Blog";
            break;

        }
        
    }
}
