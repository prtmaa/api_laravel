<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsDetailResource;
use App\Http\Resources\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::all();
        // return response()->json(['data' => $posts]);
        return PostsDetailResource::collection($posts->loadMissing('writer:id,username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $request['author'] = Auth::user()->id;

        $post = Posts::create($request->all());
        return new PostsDetailResource($post->loadMissing('writer:id,username'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Posts::with('writer:id,username')->findOrFail($id);
        return new PostsDetailResource($post->loadMissing('writer:id,username'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $post = Posts::findOrFail($id);
        $post->update($request->all());
        return new PostsDetailResource($post->loadMissing('writer:id,username'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return new PostsDetailResource($post->loadMissing('writer:id,username'));
    }
}
