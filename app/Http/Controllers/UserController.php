<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::with('roles')->get();
        return Response::json($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        return Response::json($user);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $request->role_id,
        ]);


        $respone = [
            'user' => $user,
        ];

        return Response::json($respone, 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Wrong credentials'
            ], 401);
        }

        if ($user->role_id == 1) {
            $token = $user->createToken('kasirtoken', ['admin'])->plainTextToken;
        } else {
            $token = $user->createToken('kasirtoken', ['kasir'])->plainTextToken;
        }


        $response = [
            'user' => $user,
            'token' => $token,
        ];

        // return Response::json($response, 200);
        return response()->json($response, 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function update(Request $request, $id)
    {
        // if (!auth()->user()->tokencan('admin')) {
        //     abort(403, 'Unauthorized action.');
        // }
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed',
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $request->role_id,
        ]);

        return Response::json([
            'message' => 'User berhasil diubah',
            'user' => $user,
        ], 200);
    }

    public function destroy($id)
    {
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::find($id);
        $user->delete();

        return Response::json([
            'message' => 'User berhasil dihapus',
            'user' => $user,
        ], 200);
    }
}
