<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function updateProfilePicture(Request $request, User $user)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
            Storage::delete($user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile-pictures', 'public');


        $publicPath = 'public/storage/profile-pictures/' . basename($path);
        if (Storage::exists($publicPath)) {
            Storage::delete($publicPath);
        }
        Storage::copy($path, $publicPath);

        $path = $request->file('profile_picture')->store('profile-pictures');

        $user->update([
            'profile_picture' => $path,
        ]);

        return redirect()->back()->with('success', 'Profile picture updated successfully');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required',
            'phone' => [
                'required', 'regex:/^[0-9]{10,13}$/',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('phone', $request->phone);
                }),
            ],
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('home');
        }

        $user->update($request->all());

        return redirect()->route('profile', $user->id)->with('success', 'Profile updated successfully.');
    }
}
