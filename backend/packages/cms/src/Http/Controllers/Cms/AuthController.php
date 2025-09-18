<?php

namespace User\LaravelCms\Http\Controllers\Cms;

use Inertia\Inertia;
use Illuminate\Http\Request;
use User\LaravelCms\Enums\UsersType;
use Illuminate\Support\Facades\Auth;

class AuthController extends \Illuminate\Routing\Controller {

  public function showLogin() {
    return view('cms::auth.login');
  }

  public function login(Request $request) {

    $validated = $request->validate([
      'login' => 'required|string',
      'password' => 'required|string',
    ]);

    if (Auth::guard('cms')->attempt([
      'email' => $validated['login'],
      'password' => $validated['password'],
    ])) {
      // Zablokuj zwykłych użytkowników
      if (Auth::guard('cms')->user()->type === UsersType::User->value) {
        Auth::guard('cms')->logout();
        return redirect()->back()->with([
          'error' => 'Zaloguj sie jak zwykly urzytkownik'
        ]);
      }
      return Inertia::render('auth', [
        'user' => Auth::guard('cms')->user(),
      ]);
    }
    return redirect()->back()->with([
      'error' => 'Nieprawidłowe dane logowania'
    ]);
  }

  public function logout(Request $request) {
    Auth::guard('cms')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('show.login');
  }

}