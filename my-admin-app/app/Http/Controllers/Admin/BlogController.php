<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Str;

use Laracasts\Flash\Flash;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(BlogRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

            // if ($request->hasFile('banner')) {
            //     $bannerPath = $request->file('banner')->store('uploads/banners', 'public');
            //     $blog->banner = $bannerPath;
            // }

            // if ($request->hasFile('image')) {
            //     $imagePath = $request->file('image')->store('uploads/images', 'public');
            //     $blog->image = $imagePath;
            // }

            Blog::create($data);

            flash('Blog created successfully!')->success();
            return redirect()->route('admin.blogs.index');
        } catch (ValidationException $e) {
            flash($e->validator->errors()->first())->error();

            //flash('Failed to create blog: ' . $e->getMessage())->error();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }


    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        flash('Blog updated successfully!')->success();
        return redirect()->route('admin.blogs.index');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        flash('Blog deleted.')->error();
        return redirect()->route('admin.blogs.index');
    }
}
