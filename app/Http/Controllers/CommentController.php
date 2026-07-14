<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Comment::latest()->paginate(5);
        return view('comment.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::all(); // for dropdown
        return view('comment.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "comment" => "required",
            "post_id" => "required"
        ]);

        $table = new Comment();
        $table->comment = $request->comment;
        $table->post_id = $request->post_id;
        $table->user_id = 1; // or auth()->id()
        $table->save();

        return redirect('/comment')->withSuccess("Comment Added Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::find($id);
        $posts = Post::all();
        return view('comment.edit', compact('comment', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "comment" => "required"
        ]);

        $table = Comment::find($id);
        $table->comment = $request->comment;
        $table->post_id = $request->post_id;
        $table->save();

        return redirect('comment')->withSuccess("Updated Successfully!!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('comment')->withSuccess("Deleted Successfully!!");
    }
}
