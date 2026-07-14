<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Category::latest()->paginate(3);
        return view("category.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                "category_name" => 'required | unique:category',
                "category_pic" => "required"
            ]
        );

        //Pic upload
        $imgName = "cat" . time() . "." . $request->category_pic->extension();
        $request->category_pic->move(public_path('img'), $imgName);
        $imgPath = "/img/" . $imgName;
        //Insert
        $table = new Category();
        $table->category_name = $request->category_name;
        $table->category_pic = $imgPath;
        $table->save();

        return redirect("/category");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            "category_name" => "required"
        ]);

        $table = Category::find($category->_id);
        $table->category_name = $request->category_name;

        if (isset($request->category_pic)) {
            $imgName = "cat" . time() . "." . $request->category_pic->extension();
            $request->category_pic->move(public_path('img'), $imgName);
            $imgPath = "/img/" . $imgName;

            $table->category_pic = $imgPath;
        }

        $table->save();
        return redirect('category')->withSuccess("Updated Successfully!!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return redirect('category')->withSuccess('Deleted Successfully..');
    }
}
