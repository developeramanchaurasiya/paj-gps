<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Device;

class AuthController extends Controller
{
    // Register User
    public function register(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => false
            ], 422);  // Validation error response
        }

        // Check if email exists already
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json([
                'message' => 'Email address is already taken.',
                'status' => false
            ], 400);  // Bad Request for email conflict
        }

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'status' => true,
            'user' => $user
        ], 201);  // 201 Created response
    }

    // Login User
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // If user does not exist or password is incorrect
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
                'status' => false
            ], 401);  // Unauthorized error
        }

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'status' => true
        ]);
    }

    // Get User Info
    public function getUserInfo(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
            'status' => true
        ]);
    }

    // List Devices User Has Access To
    public function listDevices(Request $request)
    {
        $user = $request->user();

        // Assuming a user can have many devices through an access table
        $devices = $user->devices;  // Assuming user has a 'devices' relationship

        return response()->json([
            'devices' => $devices,
            'status' => true
        ]);
    }

    // Get Single Device Info
    public function getDeviceInfo($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json([
                'message' => 'Device not found',
                'status' => false
            ], 404);  // Not Found error
        }

        return response()->json([
            'device' => $device,
            'status' => true
        ]);
    }

    // Token Refresh (re-issue access token)
    public function refreshToken(Request $request)
    {
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'status' => true
        ]);
    }

    // Logout User (Revoke All Tokens)
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();  // Revoke all user tokens

        return response()->json([
            'message' => 'Logged out successfully',
            'status' => true
        ]);
    }
}
