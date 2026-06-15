<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function index() {
        $users = User::latest()->paginate(15);
        return view('users.index', compact('users'));
    }

    public function edit(User $user) {
        $roles = ['educator', 'learner'];
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:educator,learner',
        ]);
        $user->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);
        return redirect()->route('users.index')->with('success', 'User updated!');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted!');
    }

    public function profile() {
    return view('users.profile', ['user' => auth()->user()]);
}

public function updateProfile(Request $request) {
    $user = auth()->user();

    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8|confirmed',
    ]);

    $user->update([
        'name'  => $request->name,
        'email' => $request->email,
    ]);

    if ($request->filled('password')) {
        $user->update(['password' => Hash::make($request->password)]);
    }

    return back()->with('success', 'Profile updated!');
}
}