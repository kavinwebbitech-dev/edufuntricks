<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'user_type' => 'admin'
        ])) {
            return redirect()->route('admin.dashboard')->with('success', 'Admin Login Successfully!');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function dashboard()
    {
        $galleries = Gallery::count();
        return view('admin.dashboard', compact('galleries'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('error', 'Admin Logout Successfully!');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $request->name,
        ];

        // ✅ PASSWORD UPDATE
        if ($request->filled('password')) {
            $data['password'] = $request->password; // auto hashed via model cast
        }

        // ✅ IMAGE UPDATE (OPTIONAL)
        if ($request->hasFile('profile_image')) {

            $file = $request->file('profile_image');

            // Delete old image
            if ($user->profile_image && file_exists(public_path('uploads/profile_images/' . $user->profile_image))) {
                unlink(public_path('uploads/profile_images/' . $user->profile_image));
            }

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/profile_images/'), $fileName);

            $data['profile_image'] = $fileName;
        }

        // ✅ UPDATE USER
        $user->update($data);

        return back()->with('success', 'Profile updated successfully');
    }

    public function settings()
    {
        $setting = Setting::first();
        return view('admin.settings', compact('setting'));
    }

    public function updateSettings(Request $request)
    {
        $setting = Setting::first();

        // ✅ If no record, create new
        if (!$setting) {
            $setting = new Setting();
        }

        $request->validate([
            'site_name' => 'required',
            'admin_email' => 'required|email',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image'
        ]);

        if ($request->hasFile('logo')) {
            $setting->logo = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $setting->favicon = $request->file('favicon')->store('settings', 'public');
        }

        $setting->site_name = $request->site_name;
        $setting->admin_email = $request->admin_email;
        $setting->footer_text = $request->footer_text;

        $setting->save();

        return back()->with('success', 'Settings saved successfully');
    }
}
