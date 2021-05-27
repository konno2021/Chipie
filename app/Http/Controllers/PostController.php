<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_status = Controller::get_user_status();
        if($user_status === 3){
            $post_lists=Post::with('user')->with('plan')->paginate(20);
            return view('post/post_index', ['post_lists'=>$post_lists]);
        }
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cookie::queue('poster_name', $request->poster_name, 43200);
        $post = new Post;
        $post->create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 3){
            return view('post.post_show', ['post'=>$post]);
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 3){
            return view('post.post_edit', ['post'=>$post]);
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $user_status = Controller::get_user_status();
        if($user_status === 3){
        $this->validate($request, [
            'poster_name' => 'required|max:255',
            'title' => 'required|max:255',
            'content' => 'required|max:255',
            'value' => 'required',
        ]);
        
        $post->update($request->all());
          return redirect(route('admin_top'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        
        $user_status = Controller::get_user_status();
        if($user_status === 3) {
            $post->delete();
            return redirect(route('admin_top'));
        }
        return back();
    }
}
