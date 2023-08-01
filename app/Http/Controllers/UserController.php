<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list() {
      $getRecord = User::get()->where('user_type', 0);      
      return view('admin.user.list', compact('getRecord'));
    }

    public function add() {
      return view('admin.user.add');
    }

    public function insert(Request $request) {
      request()->validate([
        'email' => 'required|email|unique:users',
        'name' => 'required|max:255',
        'password' => 'required|min:8'
      ]);

      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->user_type = 0;
      $user->save();

      return redirect('admin/users/list');
    }

    public function edit(Request $request, $id) {
      $user = User::findOrFail($id);
      return view('admin.user.edit', compact('user'));
    }

    public function update($id, Request $request) {
      request()->validate([
        'email' => 'required|email|unique:users,email,'.$id,
        'name' => 'required|max:255',
      ]);

      $user = User::findOrFail($id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->save();

      return redirect('admin/users/list');

    }

    public function delete($id) {
      $user = User::findOrFail($id);
      $user->delete();

      return redirect('admin/user/list');
    }
}
