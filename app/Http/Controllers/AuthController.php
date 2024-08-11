<?php

namespace App\Http\Controllers;

use App\Models\InviteCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Check for potential path traversal in a string
    private function hasPathTraversal($value)
    {
        // Use a stricter check for potential path traversal
        return strpos($value, '../') !== false || strpos($value, '..\\') !== false;
    }

    // Handle user registration
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = [
            'username' => 'required|min:3|max:30|unique:users,username',
            'email' => [
                'required',
                'email',
                'max:100',
                'not_regex:/\.\.\//', // Prevent path traversal in email
                function ($attribute, $value, $fail) {
                    if ($this->hasPathTraversal($value)) {
                        $fail('Invalid email format');
                    }
                },
                'unique:users,email',
            ],
            'password' => 'required|min:8|max:255|confirmed', // Confirm password
            'invite' => 'required|exists:invite_codes,code', // Validate invite code existence
        ];

        $validator = Validator::make($request->all(), $validated);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return redirect()->back()->withErrors(['error' => $error]);
        }

        $inviteCode = trim($request->invite);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new user
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Delete the used invite code
            InviteCode::where('code', $inviteCode)->delete();

            // Commit the transaction
            DB::commit();

            activity()
                ->causedBy($user)
                ->event('user.registered')
                ->log('Käyttäjä ' . $user->username . ' rekisteröityi kutsukoodilla ' . $inviteCode);

            // Redirect to the login page with success message
            return redirect()->route('login')->with('success', 'Käyttäjä luotu!');
        } catch (\Exception $e) {
            // Log the error
            Log::error($e);
            // An error occurred, rollback the transaction
            DB::rollBack();

            // Handle the error, you may log it or display an error message
            return redirect()->back()->withErrors(['invite' => 'Jotain meni pieleen.']);
        }
    }

    public function authenticate(Request $request) {
        $validated = [
            'username' => 'required|min:3|max:30|exists:users,username',
            'password' => 'required|min:8|max:255',
        ];

        $validator = Validator::make($request->all(), $validated);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return redirect()->back()->withErrors(['error' => $error]);
        }

        $remember = request()->has('remember');

        if (auth()->attempt($request->only('username', 'password'), $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Kirjauduit sisälle!');
        }

        return redirect()->back()->withErrors(['login' => 'Virheellinen käyttäjänimi tai salasana.']);
    }

    public function logout() {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Kirjauduit ulos!');
    }

    // Display registration form
    public function register()
    {
        return view('auth.register');
    }

    // Display login form
    public function login()
    {
        return view('auth.login');
    }
}
