<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = Validator::make($request->all(), [
            'name' => 'string|required',
            'email' => 'string|required|unique:users',
            'phone' => 'string|required',
            'password' => 'string|required|confirmed',
        ]);

        // --------  check if the data is correct  ------------- \\
        if ($fields->fails()) {
            return new JsonResponse(['success' => false, 'message' => $fields->errors()], 422);
        }

        // --------  create user in database  ------------- \\
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        // ---------  create token for the registered user and save it  --------- \\
        $token = $user->createToken('token')->plainTextToken;


        // ---------  return with custom attributes  --------- \\
        $response = [
            'id,' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'token' => $token
        ];

        // ---------  return data and add headers  --------- \\
        return new JsonResponse(
            [
                'success' => true,
                'data' => $response,
                'message' => 'User created successfully.',
            ],
            201,
            [
                'Accept' => 'application/json',
                'content-type' => 'application/json',
            ]
        );
    }
    public function login(Request $request)
    {
        // --------  validate on the requested data   ------------- \\
        $fields = $request->validate([
            'email' => 'string|required',
            'password' => 'string|required',
        ]);

        // --------  check email in database  ------------- \\
        $user = User::where('email',$fields['email'])->first();


        // --------  check email in database  ------------- \\
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Email or Password is incorrect'
            ], 401);
        }


        // ---------  create token for the user and save it  --------- \\
        $token = $user->createToken('token')->plainTextToken;


        // ---------  return with custom attributes  --------- \\
        $response = [
            'id,' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'token' => $token
        ];


        // ---------  return data and add headers  --------- \\
        return response([
            'success' => true,
            'data' => $response,
        ],
            201,
            [
                'Accept' => 'application/json',
                'content-type' => 'application/json',
            ]);
    }
    public function logout(): array
    {
        // -------------  delete user tokens  ------------ \\
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
