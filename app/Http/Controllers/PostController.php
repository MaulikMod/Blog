<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Post::paginate(3);
        return view('post.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::get();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                "title" => "required",
                "post_image" => "required",
                "content" => "required | min:1",
                "status" => "required",
            ]
        );
        $imgName = "post_" . time() . "." . $request->post_image->extension();
        $request->post_image->move(public_path('img'), $imgName);
        $imgPath = "/img/" . $imgName;

        $table = new Post();
        $table->title = $request->title;
        $table->category = $request->category;
        $table->post_image = $imgPath;
        $table->content = $request->content;
        $table->status = (int) $request->status;

        $table->save();

        return redirect("post")->withSuccess("Post Inserted Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::get();

        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // ✅ Validation
        $request->validate([
            "title" => "required",
            "content" => "required|min:1",
            "status" => "required",
        ]);

        // ✅ Find using _id (MongoDB style like your product)
        $table = Post::find($post->_id);

        // ✅ If new image uploaded
        if (isset($request->post_image)) {

            $imgName = "post_" . time() . "." . $request->post_image->extension();
            $request->post_image->move(public_path('img'), $imgName);
            $imgPath = "/img/" . $imgName;

            $table->post_image = $imgPath;
        }

        // ✅ Update fields
        $table->title = $request->title;
        $table->category = $request->category;
        $table->content = $request->content;
        $table->status = (int) $request->status;

        $table->save();

        return redirect("post")->withSuccess("Updated Success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect("post")->withSuccess("Deleted Successfully!!!");
    }
}
