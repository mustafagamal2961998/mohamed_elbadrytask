<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Post::with('media','comments')->latest()->get();
        return response()->json([
            'data'=>BlogResource::collection($blogs),
              'statusCode'=>200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $request->merge(['user_id'=>Auth::id()]);
        $store = Post::create($request->all());
        if($request->hasFile('cover')){
            $store->addMedia($request->file('cover'))
                   ->usingName('Blog Cover')
                   ->toMediaCollection('cover');
        }
        return response()->json([
            'data'=>'Blog created successfully!',
            'statusCode'=>200,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Post::with('media','comments')->find($id);
        return response()->json([
            'data'=>new BlogResource($blog),
            'statusCode'=>200,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        
        $store = Post::find($id);
        $store->update($request->all());
        if($request->hasFile('cover')){
            $store->clearMediaCollection('cover');
            $store->addMedia($request->file('cover'))
                   ->usingName('Blog Cover')
                   ->toMediaCollection('cover');
        }
        return response()->json([
            'data'=>'Blog updated successfully!',
            'statusCode'=>200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Post::find($id);
        if(!$delete){
            return response()->json([
                'data'=>'Blog not exist!',
                'statusCode'=>422,
            ]);
        }
        $delete->clearMediaCollection('cover');
        $delete->delete();
        return response()->json([
            'data'=>'Blog deleted successfully!',
            'statusCode'=>200,
        ]);
    }
}
