<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Role;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
         if ($user->biodata === null) {
        if ($user->role_id == 1) {
            return redirect()->route('biodata.edit');
        } elseif ($user->role_id == 2) {
            return redirect()->route('student.biodata.edit');
        } elseif ($user->role_id == 3) {
            return redirect()->route('lecture.biodata.edit');
        }
    }

        // Redirect berdasarkan role
        if ($user->role_id == 1) {
            return redirect()->intended('/admin/dashboard');
        } elseif ($user->role_id == 2) {
            return redirect()->intended('/user/dashboard');
        }
        elseif ($user->role_id == 3) {
            return redirect()->intended('/user/dashboard');
        }
        elseif ($user->role_id == 4) {
            return redirect()->intended('/technician/dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
