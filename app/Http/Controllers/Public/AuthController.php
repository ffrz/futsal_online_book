<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private function _logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function login()
    {
        return view('public.auth.login');
    }

    public function processLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Kata sandi harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if (!Auth::attempt($request->only(['email', 'password'], $request->remember))) {
            $this->_logout($request);
            return back()->withInput()->with('error')
                ->with('message', 'Email atau kata sandi salah!');
        }

        if (env('AUTH_LOGIN_MUST_VERIFY_EMAIL')) {
            $user = Auth::user();
            if (!$user->email_verified_at) {
                $this->_logout($request);
                return back()->withInput()->with('error')
                    ->with('message', 'Email anda belum terverifikasi. Silahkan cek email dan verifikasi akun anda!');
            }
        }

        return redirect(route('home'));
    }

    public function logout(Request $request)
    {
        $this->_logout($request);
        return redirect('/');
    }

    public function register()
    {
        return view('public.auth.register');
    }

    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.min' => 'Nama terlalu pendek, minimal 2 karakter.',
            'name.max' => 'Nama terlalu panjang, maksimal 100 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.max' => 'Email terlalu panjang.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kata sandi harus diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai.',
            'password.min' => 'Kata sandi terlalu pendek.',
            'password_confirmation.required' => 'Konfirmasi kata sandi harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = $request->all();
        $data['group_id'] = 4;
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return redirect(route('registration-success'))
            ->with('email', $user->email);
    }

    public function registrationSuccess()
    {
        $email = session('email', '-');
        return view('public.auth.registration-success', compact('email'));
    }

    public function forgotPassword()
    {
        return view('public.auth.forgot-password');
    }

    public function recoverPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Alamat email anda tidak valid.',
            'email.exists' => 'Alamat email tidak ditemukan.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordRequestSent(Request $request)
    {
        return view('public.auth.reset-password-request-sent');
    }
}
