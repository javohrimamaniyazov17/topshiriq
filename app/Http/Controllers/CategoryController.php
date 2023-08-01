<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function list()
    {
        $getRecord = Category::get();
        return view('user.category.list', compact('getRecord'));
    }

    public function add()
    {
        return view('user.category.add');
    }

    public function insert(Request $request)
    {
        // dd($request->all());

        request()->validate([
            'name' => 'required|max:255',
            'image' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->name;

        if (!empty($request->file('image'))) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $extension;
            $file->move('images/category/', $filename);

            $category->image = $filename;
        }

        $category->status = $request->status;
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect('user/category/list');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        if (Auth::user()->id === $category->user_id) {
            return view('user.category.edit', compact('category'));
        }

        return redirect('user/category/list');
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',
            'image' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->status = $request->status;
        if (Auth::user()->id === $category->user_id) {
            $category->name = $request->name;
            if (!empty($request->file('image'))) {
                if (!empty($category)) {
                    unlink('upload/images/' . $category->image);
                }
                $extension = $request->file('image')->getClientOriginalExtension();
                $file = $request->file('image');
                $randomStr = date('Ymdhis') . Str::random(20);
                $filename = strtolower($randomStr) . '.' . $extension;
                $file->move('upload/images/', $filename);

                $category->image = $filename;
            }
            $category->status = $request->status;
            $category->save();

            return redirect('user/category/list');
        }

        return redirect('user/category/list');
    }

    public function delete($id)
    {

        $category = Category::findOrFail($id);
        if (Auth::user()->id === $category->user_id) {
            $category->delete();

            return redirect('user/category/list');
        }

        return redirect('user/category/list');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('user.category.show', compact('category'));
    }
}
