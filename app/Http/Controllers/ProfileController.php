<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    public function editprofile()
    {
        $user = Auth::user();
        return view('profile.edit-profile', compact('user'));
    }
    
    public function updateprofile(Request $request)
    {
        $user = Auth::user();
        $name = $request->name;
        $phone = $request->phone;
        $password = Hash::make($request->password);
        
        if ($request->hasFile('avatar')) {
            // $avatar = $user->identity_number . "." . $request->file('avatar')->getClientOriginalName();
            $avatar = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatar = $user->avatar;
        }
        
        if (empty($request->password)) {
            $data = [
                'name' => $name,
                'phone' => $phone,
                'avatar' => $avatar
            ];
        } else {
             $data = [
                'name' => $name,
                'phone' => $phone,
                'password' => $password,
                'avatar' => $avatar
            ];
        }

        $update = User::where('id', $user->id)->update($data);
        
        if ($update) {
            // if ($request->hasFile('avatar')) {
            //     // $folderPath = 'storage/app/public/avatars/';
            //     $avatar->storeAs('avatars', 'public');
            // }
            return redirect()->back()->with('success', 'Data berhasil di update');
        } else {
            return redirect()->back()->with('error', 'Data gagal di update');
        }
        
    }
}
