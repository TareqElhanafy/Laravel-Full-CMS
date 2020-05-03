<?php

namespace App\Http\Controllers;
use App\Tag;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags',Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
     Tag::create([
       'name'=>$request->name
     ]);
       session()->flash('success','Tag has been created !');
     return redirect(route('tags.index'));
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
    public function edit(Tag $tag)
    {
      return view('tags.create')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $data=$request->only(['name']);
        $tag->update($data);
        session()->flash('success','Tag has been updated !');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $tag=Tag::withTrashed()->where('id',$id)->firstOrFail();
        if ($tag->trashed()) {
          if ($tag->posts->count()>0) {
            session()->flash('error','This Tag has associated with posts,You can not delete it !');
            return redirect(route('tags.index'));
          }
          $tag->forceDelete();
        }else {
          if ($tag->posts->count()>0) {
            session()->flash('error','This Tag has associated with posts,You can not delete it !');
            return redirect(route('tags.index'));
          }
          $tag->delete();
        }
        session()->flash('success','Tag has been deleted !');
        return redirect(route('tags.index'));
    }
    public function trashed(){
      $trashed=Tag::onlyTrashed()->get();
      return view('tags.index')->with('tags',$trashed);
    }
    public function restore($id){

      $tag=Tag::withTrashed()->where('id',$id)->firstOrFail();
      $tag->restore();
      return redirect(route('tags.index'));
    }
}
