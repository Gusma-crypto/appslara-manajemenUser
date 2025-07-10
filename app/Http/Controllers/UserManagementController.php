<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $admins = User::role('admin')->get(); 
        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('superadmin.users', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('superadmin.users-create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(), 
        ]);

        $user->assignRole($request->role);

        return redirect()->route('superadmin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
         // Hapus semua role lama dan assign yang baru
        $user->syncRoles([$request->role]);
        return redirect()->back()->with('success', 'Role berhasil diperbarui.');
    }

    // update status togle blokir
    public function toggleStatus(User $user){
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->back()->with('success', 'Status user berhasil diubah.');
    }

    
}
