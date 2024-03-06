<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Post;

use App\Models\Comment;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $post=Post::where('post_status','=','active')->get();
            $usertype = Auth()->user()->usertype;

            if($usertype == 'user')
            {
                return view('home.homepage',compact('post'));
            }

            else if($usertype == 'admin')
            {
                return view('admin.adminhome');
            }
            else
            {
                return redirect()->back();
            }

        }
    }

    public function homepage()
    {

        $post = Post::where('post_status','=','active')->get();

        return view('home.homepage', compact('post'));
    }

    public function post_details($post_id)
{
    // Retrieve the post with the given $post_id
    $post = Post::find($post_id);

    // Retrieve only comments with status 'active' associated with the given post
    $comment = Comment::where('post_id', $post_id)
                       ->where('comment_status', 'active')
                       ->get();

    // Pass the post and comments to the view
    return view('home.post_details', compact('post', 'comment'));
}




    public function create_post()
    {
        return view('home.create_post');
    }

    public function user_comment(Request $request, $id)
    {
        $user = auth()->user();

        $comment = new Comment;

        $comment->comment_text = $request->comment_text;
        $comment->comment_status='pending';
        $comment->user_id = $user->id;
        $comment->user_name = $user->name;
        $comment->post_id = $id;

        $comment->save();

        Alert::success('Congrats','data has been added successfully');
        return redirect()->back()->with('message','Comment added Successfully');
    }

    public function user_post(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'post_code' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);


        $user = auth()->user();
        $userid = $user->id;
        $username = $user->name;
        $usertype = $user->usertype;


        $post = new Post;
        $post->post_code = $validatedData['post_code'];
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        $post->user_id = $userid;
        $post->name = $username;
        $post->usertype = $usertype;
        $post->post_status = 'pending';


        if ($request->hasFile('image')) {

        }


        $post->save();


        if ($post) {

            Alert::success('Congrats', 'Data has been added successfully');
            return redirect()->back();
        } else {

            Alert::error('Error', 'Failed to add post');
            return redirect()->back();
        }
    }

    public function my_post()
    {
        $user = Auth::user();

        $userid = $user->id;

        $data = Post::where('user_id','=', $userid)->get();
        return view('home.my_post', compact('data'));
    }

    public function my_post_del($id)
    {
    $post = Post::find($id);

    // Delete associated comments
    $post->comments()->delete();

    // Delete the post
    $post->delete();

    return redirect()->back()->with('message', 'Post Deleted Successfully');

    }
    public function my_post_update($id)
    {
        $data = Post::find($id);

        return view('home.my_post_update',compact('data'));
    }

    public function update_post_data(Request $request, $id)
    {
        $data = Post::find($id);
        $data->post_code = $request->post_code;

        $data->title = $request->title;

        $data->description = $request->description;
        $image = $request->image;

        if($image)
        {
            $imagename =time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage', $imagename);
            $data->image=$imagename;
        }
        $data->save();

        return redirect()->back()->with('message','Post updated Successfully');

    }
}
