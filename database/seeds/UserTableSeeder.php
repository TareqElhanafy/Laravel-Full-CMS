<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user=User::where('email','new.phrases1o0@gmail.com')->first();
      if (!$user) {
        User::create([
          'name'=>'tareq',
          'email'=>'new.phrases1o0@gmail.com',
          'role'=>'admin',
          'password' => Hash::make('password')
        ]);

      }
    }
}
