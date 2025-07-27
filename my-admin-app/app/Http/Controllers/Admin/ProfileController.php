<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\Services\FileUploadService;
use Laracasts\Flash\Flash;
use Illuminate\Validation\ValidationException;



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

        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', 'max:255', Rule::unique('admins')->ignore($admin->id)],
                'password' => 'nullable|string|min:8|confirmed',
            ]);
        } catch (ValidationException $e) {
            // Optional: flash the first validation error
            flash($e->validator->errors()->first())->error();

            return redirect()->back()
                ->withErrors($e->errors()) // For @error and $errors in blade
                ->withInput(); // Preserve form input
        }


        // Update name and email
        $admin->name = $data['name'];
        $admin->email = $data['email'];

        // If password is filled, hash it
        if (!empty($data['password'])) {
            $admin->password = Hash::make($data['password']);
        }

        // If avatar needs updating
        if (!$admin->avatar || $admin->avatar !== $data['name']) {
            $path = $this->fileuploadservice->generateAndSave($data['name']);
            $admin->avatar = $path;
        }

        $admin->save();

        // Success flash
        flash('Profile updated successfully!')->success();

        return redirect()->route('admin.profile.edit');
    }
}
