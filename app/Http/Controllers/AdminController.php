<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;

use App\Models\Post;
use App\Models\comment;
use App\Models\User;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    public function post_page()
    {
        return view('admin.post_page');
    }
    /*public function comment_page()
    {
        return view('admin.comment_page');
    }*/

    public function show_post()
    {
        $post = Post::all();
        return view('admin.show_post', compact('post'));

    }
    public function show_comment()
    {
        $comment = Comment::all();
        return view('admin.show_comment', compact('comment'));

    }
    public function restoreLatest(Request $request)
    {
        // Check if the authenticated user is an administrator
        if (!Auth::user()->usertype = "admin") {
            return redirect()->back()->with('error', 'Only administrators can restore posts.');
        }

        // Restore the most recently deleted post
        $latestDeletedPost = Post::onlyTrashed()->latest('deleted_at')->first();
        if ($latestDeletedPost) {
            $latestDeletedPost->restore();
            return redirect()->back()->with('success', 'Latest post restored successfully!');
        } else {
            return redirect()->back()->with('error', 'No post to restore.');
        }
    }

    public function delete_post($id)
    {
        try {
            // Attempt to delete the post
            $post = Post::find($id);
            $post->comments()->delete();
            $post->delete();
            //This will now soft delete the data.

            return redirect()->back()->with('message', 'This post is deleted successfully');
        } catch (QueryException $e) {
            // Handle foreign key constraint violation
            if ($e->errorInfo[1] === 1451) { // Error code 1451 represents a foreign key constraint violation
                return redirect()->back()->with('error', 'This post cannot be deleted because it is linked to other records.');
            }

            // If it's not a foreign key constraint violation, rethrow the exception
            throw $e;
        }
    }


    public function update_post(Request $request,$id)
    {
        $data = Post::find($id);
        $data->title=$request->title;
        $data->description=$request->description;
        $image=$request->image;

        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage',$imagename);
            $data-> image = $imagename;
        }

        $data->save();
        return redirect()->back()->with('message','Post has been updated sucessfully');

    }

    public function edit_page($id)
    {
        $post=Post::find($id);
        return view('admin.edit_page', compact('post'));
    }

    public function add_post(Request $request)
    {
        $user = Auth()->user();

        $userid = $user->id;
        $name = $user->name;
        $usertype = $user->usertype;

        $post = new Post;
        $post-> title = $request->title;
        $post-> description = $request-> description;
        $post-> post_status = 'active';

        $post-> user_id = $userid;
        $post-> name = $name;
        $post-> usertype = $usertype;

        $image = $request->image;

        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage',$imagename);
            $post-> image = $imagename;

        }

        $post->save();

        return redirect()->back()->with('message','Post Added Successfully');

    }
    public function accept_post($id)
    {
        $data = Post::find($id);
        $data->post_status='active';
        $data->save();

        return redirect()->back();
    }
    public function accept_comment($id)
    {
        $data = comment::find($id);
        $data->comment_status='active';
        $data->save();

        return redirect()->back();
    }
    public function reject_post($id)
    {
        $data = Post::find($id);
        $data->post_status='pending';
        $data->save();

        return redirect()->back();
    }
    public function reject_comment($id)
    {
        $data = Comment::find($id);
        $data->comment_status='pending';
        $data->save();

        return redirect()->back();
    }
}
