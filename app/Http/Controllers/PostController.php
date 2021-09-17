<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    //
    public function index () {
        $posts = auth()->user()->posts()->paginate(5);//output posts this user
//        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }
    public function show(Post $post) {

        return view('blog-post', ['post' => $post]);
    }
    public function create() {
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }
    public function store() {
        $this->authorize('create', Post::class);
       $inputs = request()->validate([
            'title' => 'required|min:8|max:225',
            'post_image' => 'file',
            'body' => 'required'
        ]);
       if (request('post_image')) {
           $inputs['post_image'] = request('post_image')->store('images');
       }
        auth()->user()->posts()->create($inputs);
        session()->flash('post-created-message', 'Post was created: '. $inputs['title']);
        return redirect()->route('post.index');
    }
    public function destroy (Post $post, Request $request) {
        $this->authorize('delete', $post);
//        if (auth()->user()->id !== $post->user_id){
//        }
        $post->delete();
        session()->flash('message', 'Post was deleted');
        return back();
    }
    public function edit (Post $post) {
//        $this->authorize('view', $post);
        if (auth()->user()->can('view', $post)) {

        }
        return view('admin.posts.edit', ['post' => $post]);
    }
    public function update (Post $post) {
        $inputs = request()->validate([
            'title' => 'required|min:8|max:225',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        $this->authorize('update', $post);
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
//        auth()->user()->posts()->save($post);
//        $post->save();
        $post->update();
        session()->flash('post-update-message', 'Post was update: '. $inputs['title']);
        return redirect()->route('post.index');
    }
}
