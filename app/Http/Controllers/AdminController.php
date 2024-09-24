<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.manageUsers', compact('users'));
    }

    public function userInformation($id)
    {
        $user = User::findOrFail($id);
        return view('admin.userInformation', compact('user'));
    }

    public function supplierInformation($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.supplierInformation', compact('supplier'));
    }

    public function createUser()
    {
        $roles = Role::all(); // Fetch roles from the database
        return view('admin.addNewUser', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|in:1,2,3', // Validate role_id
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Save the role in user_roles table
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $request->role_id,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.manageUsers')->with('added_success', $request->name);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.editUser', compact('user', 'roles'));
    }
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ignore unique check for the current user
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Update the user's role
        $user->userRole()->updateOrCreate(
            ['user_id' => $id],
            ['role_id' => $request->role_id]
        );

        return redirect()->route('admin.userInformation', $id)->with('update_success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Optionally, delete the user role from the user_roles table
        $user->userRole()->delete();

        return redirect()->route('admin.manageUsers')->with('delete_success', 'User deleted successfully.');
    }



}
