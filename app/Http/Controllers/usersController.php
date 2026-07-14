<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    public function admin()
    {
        $category_count = Category::count();
        $post_count = Post::count();
        $user_count = users::count();
        //$comment_count = Comment::count();
        //$view_count = Post::sum('views');

        return view('adminhome', compact(
            'category_count',
            'post_count',
            'user_count'
            //'comment_count',
            //'view_count'
        ));
    }

    public function profile()
    {
        $sessionUser = session('user');
        if (!$sessionUser) return redirect('/login');

        // Refresh user from DB to have latest info
        $user = users::find($sessionUser->_id);
        if ($user) {
            session()->put('user', $user);
        } else {
            $user = $sessionUser; // fallback
        }

        $postCount = Post::where('user_id', $user->_id)->count();
        $commentCount = \App\Models\Comment::where('user_id', $user->_id)->count();

        return view('user-profile', compact('postCount', 'commentCount'));
    }

    public function updateProfile(Request $request)
    {
        $sessionUser = session('user');
        if (!$sessionUser) return redirect('/login');

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = users::find($sessionUser->_id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            
            // Handle profile picture upload if any
            if ($request->hasFile('profile_pic')) {
                $imgName = 'profile_' . time() . '.' . $request->profile_pic->extension();
                $request->profile_pic->move(public_path('img/profiles'), $imgName);
                $user->profile_pic = '/img/profiles/' . $imgName;
            }

            $user->save();
            session()->put('user', $user);
        }

        return back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        // Validate & update password
        return back()->with('success', 'Password changed successfully');
    }

    //
    public function login(Request $request)
    {
        if ($request->username == "admin" && $request->password == "admin") {
            return redirect("admin");
        } else {
            $data = users::where("username", $request->username)->first();

            if ($data && Hash::check($request->password, $data->password)) {
                session()->put('user', $data);
                return redirect("/home");
            } else {
                return redirect("login")->with('error', 'Invalid username or password');
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/login');
    }


    public function register(Request $request)
    {
        // 1. Validate
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 2. Create the record
        users::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            // ALWAYS hash the password before saving to Mongo
            'password' => Hash::make($request->password),
        ]);

        // 3. Move to the next chapter
        return redirect('/login')->with('success', 'Your story has begun!');
    }

    public function register_user(Request $request)
    {
        // 1. Validation - Matches your form names
        $request->validate([
            "fullname" => "required",
            "username" => "required | unique:user",
            "email" => "required | email | unique:user",
            "password" => "required | min:6",
            "con_password" => "required | same:password"
        ]);

        // 2. Create the User
        $user = users::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Always hash passwords!
        ]);

        // 3. Login and Redirect
        users::login($user);

        return redirect('/dashboard')->with('success', 'Welcome to the Daily Thoughts!');
    }

    public function resetPasswordDirect(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = users::where('username', $request->username)
            ->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/login')->with('status', 'Password updated successfully! Please log in.');
        } else {
            return back()->withErrors(['username' => 'The details provided do not match our records.']);
        }
    }

    public function login_user(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        // This attempt looks into MongoDB for the user
        if (Auth::attempt($credentials)) {
            return redirect('/home');
        } else {
            // If it's not going to /home, it's hitting this line!
            return "Login Failed. Check if the email exists in MongoDB and if the password was hashed using Hash::make().";
        }
    }

    public function getAllUser()
    {
        $data = Users::get();
        return view('adminuser', compact('data'));
    }

    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function index()
    {
        // Already logged in? Send them home.
        if (session()->has('user')) {
            return redirect('/home');
        }
        return view('register');
    }
    public function index1()
    {
        // Already logged in? Send them home.
        if (session()->has('user')) {
            return redirect('/home');
        }
        return view('login');
    }
    // public function home()
    // {
    //     return view('home');
    // }

    // public function home()
    // {
    //     $cats = Category::all();
    //     $posts = Post::latest()->get();
    //     return view('home', compact('cats', 'posts'));
    // }

    public function home()
    {
        $cats = Category::get();
        $posts = Post::orderBy('_id', 'desc')->get(); // better for MongoDB

        $postsByCategory = $posts->groupBy('category')->map(function ($group) {
            return $group->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'post_image' => url($post->post_image),
                ];
            })->values();
        })->toArray();

        return view('home', [
            'cats' => $cats,
            'posts' => $posts,
            'postsByCategory' => $postsByCategory,
        ]);
    }

    public function blog()
    {
        $cats       = Category::orderBy('category_name')->get();
        $posts      = Post::with('comments')->whereIn('status', [1, '1']) // Handle both int and string statuses
                          ->orderBy('_id', 'desc')
                          ->get();
        $totalPosts = $posts->count();

        return view('blog', compact('cats', 'posts', 'totalPosts'));
    }

    public function blogCreate()
    {
        $categories = Category::get();
        return view('blog.create', compact('categories'));
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'title'      => 'required',
            'post_image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'content'    => 'required|min:1',
            'status'     => 'required',
        ]);

        $imgName = 'post_' . time() . '.' . $request->post_image->extension();
        $request->post_image->move(public_path('img'), $imgName);

        $post           = new Post();
        $post->title    = $request->title;
        $post->category = $request->category;
        $post->post_image = '/img/' . $imgName;
        $post->content  = $request->content;
        $post->status   = (int) $request->status;
        if (session()->has('user')) {
            $post->user_id = session('user')->_id;
            $post->user_name = session('user')->name;
        }
        $post->save();

        return redirect('/blog')->with('success', 'Your post has been published! 🎉');
    }

    public function toggleLike($id)
    {
        if (!session()->has('user')) return response()->json(['error' => 'Unauthenticated'], 401);
        $user_id = session('user')->_id;
        $post = Post::findOrFail($id);

        $likes = $post->likes ?? [];
        if (in_array($user_id, $likes)) {
            $likes = array_diff($likes, [$user_id]);
        } else {
            $likes[] = $user_id;
        }

        $post->likes = array_values($likes);
        $post->save();

        return response()->json(['success' => true, 'likes_count' => count($post->likes), 'liked' => in_array($user_id, $post->likes)]);
    }

    public function postComment(Request $request, $id)
    {
        if (!session()->has('user')) return back()->with('error', 'Please login to comment.');
        
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);

        $comment = new \App\Models\Comment();
        $comment->post_id = $id;
        $comment->name = session('user')->name;
        $comment->user_id = session('user')->_id;
        $comment->comment = $request->comment;
        $comment->status = 1; // Auto-approve for now
        $comment->save();

        return back()->with('success', 'Comment added successfully!');
    }

    public function deleteComment($id)
    {
        if (!session()->has('user')) return back()->with('error', 'Unauthorized access.');

        $comment = \App\Models\Comment::findOrFail($id);
        $user_id = session('user')->_id;

        // User can delete their own comment, OR the post owner can delete any comment on their post.
        if ($comment->user_id == $user_id || ($comment->post && $comment->post->user_id == $user_id)) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        }

        return back()->with('error', 'You do not have permission to delete this comment.');
    }

    public function blogEdit($id)
    {
        $post = Post::findOrFail($id);
        // Only allow if user owns the post
        if (!session()->has('user') || session('user')->_id != $post->user_id) {
            return redirect('/blog')->with('error', 'Unauthorized action.');
        }
        $categories = Category::get();
        return view('blog.edit', compact('post', 'categories'));
    }

    public function blogUpdate(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if (!session()->has('user') || session('user')->_id != $post->user_id) {
            return redirect('/blog')->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'title'      => 'required',
            'post_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'content'    => 'required|min:1',
            'status'     => 'required',
        ]);

        if ($request->hasFile('post_image')) {
            $imgName = 'post_' . time() . '.' . $request->post_image->extension();
            $request->post_image->move(public_path('img'), $imgName);
            $post->post_image = '/img/' . $imgName;
        }

        $post->title    = $request->title;
        $post->category = $request->category;
        $post->content  = $request->content;
        $post->status   = (int) $request->status;
        $post->save();

        return redirect('/blog')->with('success', 'Your post has been updated! 🎉');
    }

    public function blogDestroy($id)
    {
        $post = Post::findOrFail($id);
        if (!session()->has('user') || session('user')->_id != $post->user_id) {
            return redirect('/blog')->with('error', 'Unauthorized action.');
        }

        $post->delete();
        return redirect('/blog')->with('success', 'Your post has been deleted.');
    }

    // Show Posts of a Category
    // public function categoryPosts($id)
    // {
    //     $cats = Category::all();
    //     $posts = Post::where('category_id', $id)->get();
    //     return view('shop', compact('cats', 'posts'));
    // }
    public function categoryPosts($id)
    {
        $cats = Category::all();

        $category = Category::find($id);

        $posts = Post::where('category', $category->category_name)->get();

        return view('shop', compact('cats', 'posts'));
    }

    // Show Single Post Details
    public function postDetail($id)
    {
        $post = Post::findOrFail($id);
        return view('postdetail', compact('post'));
    }

    // Search Posts
    public function search(Request $request)
    {
        $query = $request->search;
        $posts = Post::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('content', 'LIKE', '%' . $query . '%')
            ->get();
        $cats = Category::all();
        return view('shop', compact('posts', 'cats'));
    }
}
