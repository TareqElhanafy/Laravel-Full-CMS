<?php

namespace App\Http\Controllers;


use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $category=Category::all();
        return view('categories.index')->with('categories',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // $this->validate($request,[
        //   'name'=>'required|unique:categories'
        // ]);
        // $data=request()->all();
        // $newcat=new Category();
        // $newcat->name=$data['name'];
        // $newcat->save();
        Category::create([
          'name'=>$request->name
        ]);
        session()->flash('success','Category has been added successfuly');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit')->with('categories',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
      $data=$request->only(['name']);

     $category->update($data);

     session()->flash('success','Category has been updateded successfuly');
     return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category=Category::withTrashed()->where('id',$id)->firstOrFail();
      if ($category->trashed()) {
        $category->forceDelete();
      }else {
        $category->delete();
      }

        session()->flash('success','Category has been deleted successfuly');
        return redirect(route('categories.index'));
    }

    public function trashed (){
      $trashed=Category::onlyTrashed()->get();
      return view('categories.index')->with('categories',$trashed);
    }
}
