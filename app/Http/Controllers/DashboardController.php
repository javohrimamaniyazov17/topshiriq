<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard() {
        if(Auth::user()->user_type == 1) {
            $user = User::get()->where('user_type', 1);
            $users = User::get()->where('user_type', '0');
            $product = Product::get();
            $category = Category::get();
            return view('admin.dashboard', compact('user', 'product', 'category', 'users'));
        } else {
            return view('user.dashboard');
        }
    }
}
