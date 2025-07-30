<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Laracasts\Flash\Flash;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService) {}

    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    // if ($request->hasFile('banner')) {
    //     $bannerPath = $request->file('banner')->store('uploads/banners', 'public');
    //     $blog->banner = $bannerPath;
    // }

    // if ($request->hasFile('image')) {
    //     $imagePath = $request->file('image')->store('uploads/images', 'public');
    //     $blog->image = $imagePath;
    // }
    public function store(BlogRequest $request)
    {
        DB::beginTransaction();

        $fileFields = [
            'image' => 'image', // input name => DB column name
            'banner' => 'banner',
            'thumbnail' => 'thumbnail', // just as example
        ];

        // old file names if any
        $oldFiles = [
            'image' => $row->image ?? '', // input name => DB column name
            'banner' => $row->banner ?? '',
            'thumbnail' => $row->thumbnail ?? '',
        ];
        try {
            $data = $request->validated();
            $row = Blog::create($data);
            $type = Blog::getTypeKey();

            try {
                $this->fileUploadService->saveFiles($request, $row, $type, $fileFields, $oldFiles);
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                // Option 1: rollback and throw again
                DB::rollBack();
                return back()->with('error', 'File upload failed. Please try again.');
            }

            DB::commit();
            flash('Blog created successfully!')->success();
            return redirect()->route('admin.blogs.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flash('Something went wrong: ' . $e->getMessage())->error();
            return redirect()->back()->withInput();
        }
    }



    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            // Fetch the existing record
            $row = Blog::findOrFail($id);

            // Prepare file fields and old file names
            $fileFields = [
                'image' => 'image',
                'banner' => 'banner',
                'thumbnail' => 'thumbnail', // if applicable
            ];

            $oldFiles = [
                'image' => $row->image ?? '',
                'banner' => $row->banner ?? '',
                'thumbnail' => $row->thumbnail ?? '',
            ];

            $data = $request->validated();

            // Update the record data first (except file fields if you want)
            $row->update($data);

            $type = Blog::getTypeKey();

            try {
                // Save files and update file columns
                $this->fileUploadService->saveFiles($request, $row, $type, $fileFields, $oldFiles);
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                DB::rollBack();
                return back()->with('error', 'File upload failed. Please try again.');
            }

            DB::commit();

            flash('Blog updated successfully!')->success();
            return redirect()->route('admin.blogs.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flash('Something went wrong: ' . $e->getMessage())->error();
            return redirect()->back()->withInput();
        }
    }



    public function destroy(Blog $blog)
    {
        $blog->delete();
        flash('Blog deleted.')->error();
        return redirect()->route('admin.blogs.index');
    }
}
