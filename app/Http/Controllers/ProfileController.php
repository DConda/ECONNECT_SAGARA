<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar_path' => 'nullable|string',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
            'social_media' => 'nullable|array'
        ]);

        // Handle avatar update
        if ($request->filled('avatar_path')) {
            Log::info('Updating avatar', [
                'old_avatar' => $user->avatar,
                'new_avatar' => $request->avatar_path
            ]);

            // Delete old avatar if exists
            if ($user->avatar && $user->avatar !== $request->avatar_path) {
                Log::info('Deleting old avatar', ['path' => $user->avatar]);
                Storage::disk('public')->delete($user->avatar);
            }
            
            $user->avatar = $request->avatar_path;
            Log::info('Avatar updated', ['new_path' => $user->avatar]);
        }

        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->social_media = $request->social_media;

        // Update password if provided
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }
            
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully');
    }

    public function deleteAvatar()
    {
        $user = auth()->user();
        
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
            $user->save();
        }

        return back()->with('success', 'Profile picture removed successfully');
    }
} 