<?php

namespace App\Http\Controllers;

use App\Models\InviteCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Check for potential path traversal in a string
    private function hasPathTraversal($value)
    {
        // Use a stricter check for potential path traversal
        return strpos($value, '../') !== false || strpos($value, '..\\') !== false;
    }

    // Validate invite code existence
    private function validateInviteCode($inviteCode)
    {
        $invite = InviteCode::where('code', '=', $inviteCode)->first();

        if ($invite) {
            return ['exists' => true];
        } else {
            return ['exists' => false];
        }
    }

    // Handle user registration
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = request()->validate([
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
        ]);

        $inviteCode = trim($validated['invite']);
        $validationResult = $this->validateInviteCode($inviteCode);

        // If invite code exists, proceed with user creation
        if ($validationResult['exists']) {
            // Start a database transaction
            DB::beginTransaction();

            try {
                // Create a new user
                $user = User::create([
                    'username' => $validated['username'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                ]);

                // Delete the used invite code
                InviteCode::where('code', $inviteCode)->delete();

                // Commit the transaction
                DB::commit();

                // Redirect to the login page with success message
                return redirect()->route('login')->with('success', 'User created!');
            } catch (\Exception $e) {
                // Log the error
                Log::error($e);
                // An error occurred, rollback the transaction
                DB::rollBack();

                // Handle the error, you may log it or display an error message
                return redirect()->back()->withErrors(['invite' => 'Something went wrong.']);
            }
        } else {
            // Invite code does not exist, return error
            return redirect()->back()->withErrors(['invite' => 'Invalid invite code']);
        }
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
