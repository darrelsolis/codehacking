<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Http\Requests\PostsUpdateRequest;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();
        $user = Auth::user();
        if ($file = $request->file('photo_id'))
        {
            $photo = $this->createPhoto($file);
            $input['photo_id'] = $photo->id;
        }
        $user->posts()->create($input);
        $flashMessage = "The post \"{$input['title']}\" has been successfully created.";
        Session::flash('created_post', $flashMessage);
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsUpdateRequest $request, $id)
    {
        $input = $request->all();
        if ($file = $request->file('photo_id'))
        {
            $photo = $this->createPhoto($file);
            $input['photo_id'] = $photo->id;
        }
        Auth::user()->posts()
                    ->whereId($id)
                    ->first()
                    ->update($input);
        $flashMessage = "The post \"{$input['title']}\" has been successfully updated.";
        Session::flash('updated_post', $flashMessage);
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path() . $post->photo->file);
        $post->delete();
        $flashMessage = "The post \"{$post->title}\" has been successfully deleted.";
        Session::flash('deleted_post', $flashMessage);
        return redirect('/admin/posts');
    }

    public function createPhoto($file)
    {
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        $photo = Photo::create(['file' => $name]);
        return $photo;
    }

    public function post($id)
    {
        $post = Post::findOrFail($id);
        return view('post', compact('post'));
    }
}
