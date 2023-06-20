<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RolesStoreRequest;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(RolesStoreRequest $request)
    {
        $data = $request->validated();
        $role = Role::create(['name'=>$request->role, 'guard_name' => 'web',],)->givePermissionTo($request->permissions);
        return response()->json(['success' => 'true', 'data' => $role], 200);
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
