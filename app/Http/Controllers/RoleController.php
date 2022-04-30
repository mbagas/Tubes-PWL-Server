<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{

    public function index()
    {
        //
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $roles = RoleResource::collection(Role::all());

        return response()->json([
            'roles' => $roles,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $role = Role::create($request->validate([
            'role' => 'required',
        ]));
        return response()->json([
            'message' => 'Role berhasil ditambahkan',
            'role' => new RoleResource($role),
        ], 201);
    }


    public function show(Role $role)
    {
        //
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        return response()->json([
            'role' => new RoleResource($role),
        ], 200);
    }

    public function edit(Role $role)
    {
        //
    }


    public function update(Request $request, Role $role)
    {
        //
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $role->update($request->validate([
            'role' => 'required',
        ]));
        $role->role = $request['role'];
        $role->save();

        return response()->json([
            'message' => 'Role berhasil diubah',
            'role' => new RoleResource($role),
        ], 200);
    }

    public function destroy(Role $role)
    {
        //
        if (!auth()->user()->tokencan('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $role->delete();
    }
}
