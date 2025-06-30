<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

$slug = Str::slug($request->title, '-');

class BlogPostController extends Controller
{
  

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'excerpt' => 'nullable|string|max:300',
        'cover_image' => 'nullable|image',
    ]);

    $slug = Str::slug($request->title);

    // Guardar imagen si se sube
    if ($request->hasFile('cover_image')) {
        $path = $request->file('cover_image')->store('blogs', 'public');
        $validated['cover_image'] = $path;
    }

    $validated['slug'] = $slug;
    $validated['author_id'] = auth()->id();
    $validated['published'] = $request->boolean('published');
    $validated['published_at'] = $request->boolean('published') ? now() : null;

    BlogPost::create($validated);

    return response()->json(['message' => 'Post creado correctamente']);
}

}