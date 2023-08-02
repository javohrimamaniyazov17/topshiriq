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
        return view('admin.category.list', compact('getRecord'));
    }

    public function add()
    {
        return view('admin.category.add');
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

        return redirect('admin/category/list')->with('success', 'Kategoriya muvaffaqiyatli qo\'shildi');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|max:255',
            'image' => 'required'
        ]);

        $category = Category::findOrFail($id);
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

        return redirect('admin/category/list')->with('succes', 'Kategoriya ma\'lumotlari muvaffaqiyatli o\'zgartirildi');
    }

    public function delete($id)
    {

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('admin/category/list');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }
}
