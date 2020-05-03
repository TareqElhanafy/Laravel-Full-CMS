<?php

namespace App\Http\Controllers;


use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

  function __construct(){
    $this->middleware('VrerifyCategoryCount')->only(['create','store']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts=Post::all();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
      $image=$request->image->store('posts');

    $post=Post::create([
        'title'=>$request->title,
        'description'=>$request->description,
        'content'=>$request->content,
        'image'=>$image,
        'published_at'=>$request->published_at,
        'category_id'=>$request->category_id
      ]);
      if($request->tags){
        $post->tags()->attach($request->tags);
      }
      session()->flash('success','Post created successfully');
      return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data=$request->only(['title','description','content','published_at','category_id']);

        if ($request->hasFile('image')) {
          $image=$request->image->store('posts');
          Storage::delete($post->image);
           $data['image']=$image;
        }
        if($request->tags){
          $post->tags()->sync($request->tags);
        }
        $post->update($data);
        session()->flash('success','Post Updated successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post=Post::withTrashed()->where('id',$id)->firstOrFail();
      Storage::delete($post->image);
      if ($post->trashed()) {
        $post->forceDelete();
      }else {
        $post->delete();

      }
        session()->flash('success','Post deleted successfully');
        return redirect(route('posts.index'));
    }

    //Trashed post function
    public function trashed(){
      $trashed=Post::onlyTrashed()->get();
      return view('posts.index')->with('posts',$trashed);
    }

    public function restored($id){
      $post=Post::withTrashed()->where('id',$id)->firstOrFail();
    $post->restore();
    session()->flash('success','Post restored successfully');
    return redirect(route('posts.index'));


    }
  
}
