<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\NewPostCreated;
use Illuminate\Support\Facades\Mail;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::all();
       // dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        //dd($categories);
        return view('admin.posts.create', compact('categories'));
        //Mail::to($request->user())->send(new NewPostCreated($newPost));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request ->all();
        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->excerpt = $data['excerpt'];
        $newPost->cover = $data['cover'];
        $newPost->body = $data['body'];
        $newPost->author = $data['author'];
        $newPost->save();
      
        Mail::to($request->user()->email)->send(new NewPostCreated($newPost));
        dd($request->user());
        return redirect()->route('admin.posts.index');
        
        // verificare se la richiesta ha un file
        /* if($request->hasfile('cover')){
         $request->validate([
            'cover'

        ]);
        }
         */
        //valida file

        // salvo nel filesystem

        //recipero percorso

        //passo all'array di dati validti 

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
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
        //dd($request->all());
        //$val_post = $request->validated();
        //dd($val_post);
        //$post->update($val_post);
        // redirect to get route
        //return redirect()->route('admin.posts.index');
        $post->title = $request->input('title');
        $post->excerpt = $request->input('excerpt');
        $post->cover = $request->input('cover');
        $post->body = $request->input('body');
        $post->author = $request->input('author');
        $post->save();
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
