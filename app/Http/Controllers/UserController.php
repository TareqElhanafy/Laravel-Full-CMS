<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
  public function index(){
    return view('users.index')->with('users',User::all());
  }
  public function update(User $user){
    $user->role='admin';
    $user->save();
    return redirect(route('users.index'));

  }
  public function profile(){
    return view('users.profile')->with('users',auth()->user());
  }
  public function edit(){
    $user=auth()->user();
    return view('users.edit')->with('user',$user);
  }
  public function updateprofile(UpdateUserRequest $request){

    $user=auth()->user();

    $user->update([
      'name'=>$request->name,
      'about'=>$request->about
    ]);
    return redirect(route('user.profile'));
  }
}
