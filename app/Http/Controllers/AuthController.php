<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('admin/dashboard');
            }
            return redirect()->intended('teacher/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:teacher,admin'
        ];

        // Add conditional validation based on role
        if ($request->role === 'teacher') {
            $rules['employee_id'] = 'required|string|unique:teachers';
            $rules['phone'] = 'required|string';
            $rules['department'] = 'required|string';
        } else {
            // For admin, these fields are optional
            $rules['employee_id'] = 'nullable|string';
            $rules['phone'] = 'nullable|string';
            $rules['department'] = 'nullable|string';
        }

        $request->validate($rules);

        // Create user with selected role
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        // Only create teacher profile if role is teacher AND employee_id is provided
        if ($request->role === 'teacher' && $request->filled('employee_id')) {
            Teacher::create([
                'user_id' => $user->id,
                'employee_id' => $request->employee_id,
                'phone' => $request->phone,
                'department' => $request->department
            ]);
        }
        // For admin, no teacher profile is created

        Auth::login($user);

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('teacher.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}