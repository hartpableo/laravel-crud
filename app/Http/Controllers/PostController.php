<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(3);

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2028'],
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
            'description' => ['required'],
        ]);

        // Prevent conflicts with uploaded files/images that has the same names
        $file_name = time() . '_' . $request->image->getClientOriginalName();
        $file_path = 'storage/' . $request->image->storeAs('uploads', $file_name);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->image = $file_path;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        return view('edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
            'description' => ['required'],
        ]);

        // Validate the image only if an image is actually uploaded
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'image', 'max:2028'],
            ]);

            // Prevent conflicts with uploaded files/images that has the same names
            $file_name = time() . '_' . $request->image->getClientOriginalName();
            $file_path = 'storage/' . $request->image->storeAs('uploads', $file_name);

            // Delete the image that was being replaced with the new image
            File::delete(public_path($post->image));

            $post->image = $file_path;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');
    }

    /**
     * Show trashed resource in storage.
     */
    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(3);
        
        return view('trashed', compact('posts'));
    }

    /**
     * Restored trashed resource in storage.
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        
        return redirect()->back();
    }

    /**
     * Force/permanently delete trashed resource in storage.
     */
    public function force_destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        File::delete(public_path($post->image));
        $post->forceDelete();
        
        return redirect()->back();
    }
}
