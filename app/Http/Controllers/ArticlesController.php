<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Article;
use App\Tag;
use App\Http\Requests\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ArticlesController extends Controller
{
    public function __construct(){
        $this->middleware('admin',['except' => ['index','show']]);
    }

    public function index(){

        //pubilished is a scope on the Article model
        $category = Input::get('category');
        if($category!=''){
    	   $articles = Article::latest('published_at')->where('category',$category)->published()->paginate(10);
        }else{
            $articles = Article::latest('published_at')->published()->paginate(10);
        }

    	return view('articles.index',compact('articles','category'));

    }

    public function show(Article $article){

    	return view('articles.show',compact('article'));
    }

    public function preview(ArticleRequest $article){
        //to fix problem where ArticleRequest has tagList and Article has tags as an attribute.
        $article->tags = Tag::whereIn('id',$article->tagList)->get();       
        return view('articles.show',compact('article'));
    }

    public function create(){
        $tags= Tag::lists('name','id');
    	return view('articles.create',compact('tags'));
    }

    public function store(ArticleRequest $request){

        $article = Article::create($request->all());
        $tagIds = $request->input('tagList');
        $article->tags()->attach($tagIds); 

        \Session::flash('success_message','Your article has been created!');

        return redirect('/articles');
    }

    public function edit(Article $article){

        $tags= Tag::lists('name','id');

        return view('articles.edit',compact('article','tags'));
    }

    public function update(ArticleRequest $request, Article $article){

        $article->update($request->all());
        $tagIds = $request->input('tagList');
        $article->tags()->sync($tagIds);

        return redirect('/articles');
    }

}
