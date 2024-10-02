<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostService extends Model
{
    use HasFactory;

    public function validatePost(Request $request): array
    {
        return $request->validate([
            'barta' => 'required|string|max:255',
        ]);
    }

    public function getAllPostsWithAuthors()
    {
        return Post::with('author')->orderBy('created_at', 'desc')->get();
    }

    public function storePost(Request $request)
    {
        
        $validated = $this->validatePost($request);

        return  Post::create([
            'body' => $validated['barta'],
            'slug' => Str::uuid(),
            'author_id' => auth()->id(),
        ]);     
    }

    public function updatePost(Request $request,  $id)  {
        $post = Post::with('author')->find($id);
        $validated = $this->validatePost($request);
        $post->body = $validated['barta'];
        return $post->save();
        
    }
}
