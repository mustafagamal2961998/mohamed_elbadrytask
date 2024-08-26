<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\BlogRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Post::with('comments','media')->latest()->get();
        return view('Home.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog = new Post();
        return view('Home.create',compact('blog'));
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
        return redirect()->route('home.index')->with('success','Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Post::find($id);
        return view('Home.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Post::find($id);
        return view('Home.edit',compact('blog'));
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
        return redirect()->route('home.index')->with('success','Post created successfully!');

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
        $delete->clearMediaCollection('cover');
        $delete->delete();
        return redirect()->route('home.index')->with('success','Blog deleted successfully!');
    }
}
