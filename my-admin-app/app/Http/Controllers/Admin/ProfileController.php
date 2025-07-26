<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Services\FileUploadService;

class ProfileController extends Controller
{
    public $fileuploadservice;
    public function __construct()
    {
        $this->fileuploadservice = new FileUploadService();
    }
    public function edit()
    {
        return view('admin.profile.edit');
    }

    /**
     * Update the admin profile
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function update(Request $request)
    {
        $admin = auth('admin')->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('admins')->ignore($admin->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->name = $data['name'];
        $admin->email = $data['email'];

        if (!empty($data['password'])) {
            $admin->password = Hash::make($data['password']);
        }

        // $this->fileuploadservice->saveFiles($request, $products, 'products');

        $path = $this->fileuploadservice->generateAndSave($data['name']);
        $admin->avatar = $path;
        $admin->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
