<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function list(Request $request)
    {
        $getRecord = Product::select('products.*', 'categories.name as category_name', 'users.name as created_by_name')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('users', 'users.id', '=', 'products.user_id');

        $searchName = $request->input('name');
        if ($searchName) {
            $getRecord->where('products.name', 'like', '%' . $searchName . '%');
        }

        $products = $getRecord->get();

        return view('admin.product.list', compact('products'));
    }

    public function add()
    {
        $category = Category::get();
        return view('admin.product.add', compact('category'));
    }

    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',
            'image' => 'required',
            'category_id' => 'required'
        ]);

        $product = new Product;
        $product->name = $request->name;
        if (!empty($request->file('image'))) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $extension;
            $file->move('images/product', $filename);

            $product->image = $filename;
        }
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->user_id = Auth::user()->id;
        $product->save();

        return redirect('admin/product/list')->with('success', 'Mahsulot muvaffaqiyatli qo\'shildi');
    }

    public function edit($id, Request $request)
    {
        $category = Category::get();
        $product = Product::findOrFail($id);

        return view('admin.product.edit', compact('product', 'category'));
    }


    public function update($id, Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',
            'image' => 'required',
            'category_id' => 'required'
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        if (!empty($request->file('image'))) {
            if (!empty($product)) {
                unlink('images/product/' . $product->image);
            }
            $extension = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $extension;
            $file->move('images/product/', $filename);

            $product->image = $filename;
        }
        $product->save();

        return redirect('admin/product/list')->with('success', 'Mahsulot ma\'lumotlari muvaffaqiyatli o\'zgartirildi');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('admin/product/list')->with('success', 'Mahsulot muvaffaqiyatli o\'chirildi');
    }

    public function show($id)
    {
        $category = Category::get();
        $product = Product::findOrFail($id);
        return view('admin.product.show', compact('category', 'product'));
    }
}
