<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Services\PostService;


class PostController extends Controller
{
    protected PostService $postService;
    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }
    
    public function index()
    {
        $posts = $this->postService->getAllPostsWithAuthors();
        return view('posts.index', compact('posts'));
    }

   
    public function create()
    {
        return view('posts.create-post');
    }


    public function store(Request $request)
    {
        $post = $this->postService->storePost($request);
        if ($post) {
            return to_route('posts.index')->with('success', 'Post created successfully!');
        }
        return back()->with('error','Post creation failed.');
    }

   
    public function show(string $id)
    {
        $post = Post::with('author')->find($id);
        return view('posts.barta-card', compact('post'));
    }

    public function edit(string $id)
    {
        $post = Post::with('author')->find($id);
        
        if (auth()->user()->id !== $post->author->id) {
            return redirect()->route('posts.index')->with('error', 'This is not authorized author!.');
        }
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }
        
        return view('posts.edit-post', compact('post'));
    }

  
    public function update(Request $request, string $id)
    {
        $updatedPost = $this->postService->updatePost($request, $id);

        if ($updatedPost) {
            return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
        }
        return back()->with('error', 'Failed to update post.');
    }

    public function destroy(string $id)
    {
        $post = Post::with('author')->find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }
        $this->authorizePostOwnership($post);

        return $post->delete() ? to_route('posts.index')->with('success', 'The Post is Deleted') : back()->with('error', 'The Post is not Deleted');
        
    }

    protected function authorizePostOwnership(Post $post)
    {
        if (auth()->user()->id !== $post->author->id) {
            abort(403, 'This action is unauthorized.');
        }
    }
}
