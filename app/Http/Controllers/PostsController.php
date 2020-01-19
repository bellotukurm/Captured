<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function explore()
    {
        $users = User::all()->pluck('id');
        
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(7);
        
        return view('posts.explore', compact('posts'));
    }

    public function index()
    {
        $users = auth()->user()->subscriptions()->pluck('profiles.user_id');
        
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(7);
        
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function edit(Post $post)
    {
        $this->authorize('update',$post);
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $this->authorize('update',$post);
        $data = request()->validate([
            'caption'=>'required',
            'image'=>'',
        ]);

        if(request('image')){
            $imagePath = request('image')->store('uploads','public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
            $image -> save();

            $imageArray = ['image'=>$imagePath];
        }
        
        
        auth()->user()->posts->find($post->id)->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/post/{$post->id}");
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'image',
        ]);

        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
        
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
            $image -> save();

            auth()->user()->posts()->create([
                'caption' => $data['caption'],
                'image' => $imagePath,
            ]); 
        }else{
            auth()->user()->posts()->create([
                'caption' => $data['caption'],
                'image' => '',
            ]);
        }

        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(\App\Post $post)
    {
        return view('posts.show',compact('post'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('update',$post);
        $post->delete();
        return redirect("/profile/$post->user_id")->with('message','The post has been deleted.');
    }
}
