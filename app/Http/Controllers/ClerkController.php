<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClerkController extends Controller
{
    public function clerkDashboard() {
        return view('clerk.dashboard');
    }

    public function createUser() {
        $roles = User::allowedRolesForClerk();
        return view('clerk.users.create', compact('roles'));
    }

    public function storeUser(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(User::allowedRolesForClerk())],
        ]);

        User::create([
            ...$validated,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('clerk.dashboard')->with('success', 'Usuario creado con éxito.');
    }

    public function editUser(User $user) {
        if($user->role === User::ROLE_ADMIN) {
            abort(403, 'Unauthorized');
        }

        $roles = User::allowedRolesForClerk();

        return view('clerk.users.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, User $user) {
        if($user->role === User::ROLE_ADMIN) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ['required', Rule::in(User::allowedRolesForClerk())],
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'role' => $validated['role'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('clerk.dashboard')->with('success', 'Usuario actualizado con éxito.');
    }
}
