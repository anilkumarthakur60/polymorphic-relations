<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('images', 'media')->get();

        return view('posts.index', compact('posts'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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

        $post = Post::create(["title" => $request->title, "body" => $request->body]);
        // $input = $request->all();
        // $images = array();
        if ($files = $request->file('fileimage')) {
            foreach ($files as $file) {
                $name = $file->store('image', 'public');

                $image = $post->images()->create(["imagefile" => $name]);
                // $image = new Image(["imagefile" => $name]);
                // $post->images()->save($image); use either
            }
        }

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }



    public function mediapost(Request $request)
    {
        $input = $request->all();
        $client = Post::create($input);
        if ($request->file('fileimage')) {
            foreach ($request->file('fileimage') as $photo) {
                $client->addMedia($photo)->toMediaCollection('post');
            }
        }

        return redirect(route('posts.index'));
    }
    public function getpost()
    {
        return view('posts.newcreate');
    }
}