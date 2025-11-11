<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        return view('/auth/users/index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return view('/auth/users/show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        return view('/auth/users/edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'education' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'skills' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                $oldImagePath = storage_path('app/public/' . $user->profile_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            // Store new image
            $image = $request->file('profile_image');
            $imageName = 'profile_' . $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('profile_images', $imageName, 'public');
            $user->profile_image = $path;
        }
        
        // Update profile fields
        $user->education = $request->input('education');
        $user->location = $request->input('location');
        $user->skills = $request->input('skills');
        $user->notes = $request->input('notes');
        
        $user->save();
        
        return redirect()->route('users.show', $user->id)->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
