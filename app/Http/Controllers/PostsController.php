<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
class PostsController extends Controller
{
  public function show(Post $post){
    return view('blog.show')->with('post',$post);
  }

  public function category(Category $category){
    $search=request()->query('search');
    if ($search) {
      $posts=$category->posts()->where('title','LIKE',"%{$search}%")->paginate(2);
    }else {
$posts=$category->posts()->paginate(2);
    }
    return view('blog.category')
    ->with('category',$category)
    ->with('posts',$posts)
    ->with('categories',Category::all())
    ->with('tags',Tag::all());
  }
  public function tag(Tag $tag){
    $search=request()->query('search');
    if ($search) {
      $posts=$tag->posts()->where('title','LIKE',"%{$search}%")->paginate(2);
    }else {
$posts=$tag->posts()->paginate(2);
    }
    return view('blog.tag')
    ->with('tag',$tag)
    ->with('posts',$posts)
    ->with('categories',Category::all())
    ->with('tags',Tag::all());
  }
}
