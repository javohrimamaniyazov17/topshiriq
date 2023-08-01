<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function list()
    {
        $getRecord = Product::select('products.*', 'categories.name as category_name')->join('categories', 'categories.id', '=', 'products.category_id', 'left')->get();
        return view('user.product.list', compact('getRecord'));
    }

    public function add()
    {
        $category = Category::get();
        return view('user.product.add', compact('category'));
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

        return redirect('user/product/list')->with('success', 'Mahsulot muvaffaqiyatli qo\'shildi');
    }

    public function edit($id, Request $request)
    {
        $category = Category::get();
        $product = Product::findOrFail($id);
        if (Auth::user()->id === $product->user_id) {
            return view('user.product.edit', compact('product', 'category'));
        }

        return redirect('user/product/list')->with('error', "Siz bunday huquqqa ega emassiz");
    }


    public function update($id, Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',
            'image' => 'required',
            'category_id' => 'required'
        ]);

        $product = Product::findOrFail($id);

        if (Auth::user()->id === $product->user_id) {
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

            return redirect('user/product/list')->with('success', 'Mahsulot ma\'lumotlari muvaffaqiyatli o\'zgartirildi');
        }

        return redirect('user/product/list')->with('error', "Siz bunday huquqqa ega emassiz");
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if (Auth::user()->id === $product->user_id) {
            $product->delete();

            return redirect('user/product/list')->with('success', 'Mahsulot muvaffaqiyatli o\'chirildi');
        }

        return redirect('user/product/list')->with('error', "Siz bunday huquqqa ega emassiz");
    }

    public function show($id)
    {
        $category = Category::get();
        $product = Product::findOrFail($id);
        return view('user.product.show', compact('category', 'product'));
    }
}