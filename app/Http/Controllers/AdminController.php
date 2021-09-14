<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        $user_roles = Role::where('id', '!=', 1)->pluck('name', 'id');
        return view('admin.create', compact('user_roles'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'email' => 'required|email|max:120|unique:users,email',
                'password' => 'required|min:6|max:24',
                'role_id' => 'required|integer',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('msg-error', $validator->errors()->first());
            }

            $data = [
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role_id'   => $request->role_id,
                'status'    => $request->status
            ];

            User::create($data);
            return redirect()->back()->with('msg-success', 'User created successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('msg-error', $e);
        }
    }

    public function adminUsers()
    {
        $users = User::where('role_id', '!=', 1)->get();
        return view('admin.users', compact('users'));
    }

    public function edit($id)
    {
        $user = User::where('role_id', '!=', 1)->find($id);
        $user_roles = Role::where('id', '!=', 1)->pluck('name', 'id');
        return view('admin.edit', compact('user', 'user_roles'));
    }

    public function update($id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'role_id' => 'required|integer',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('msg-error', $validator->errors()->first());
            }

            $user = User::find($id);
            if (!$user)
            {
                return redirect()->back()->with('msg-error', 'User not found!');
            }

            $data = [
                'name'      => $request->name,
                'role_id'   => $request->role_id,
                'status'    => $request->status
            ];

            User::where('id', $user->id)->update($data);
            return redirect()->back()->with('msg-success', 'User updated successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('msg-error', $e);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            if (!$user)
            {
                return redirect()->back()->with('msg-error', 'User not found!');
            }

            User::destroy($user->id);
            return redirect()->back()->with('msg-success', 'User deleted successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('msg-error', $e);
        }
    }

    public function adminRoles()
    {
        $roles = Role::get();
        return view('admin.roles', compact('roles'));
    }

    public function roleEdit($id)
    {
        $role = Role::find($id);
        return view('admin.role_edit', compact('role'));
    }

    public function roleUpdate($id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('msg-error', $validator->errors()->first());
            }

            $role = Role::find($id);
            if (!$role)
            {
                return redirect()->back()->with('msg-error', 'Role not found!');
            }

            $data = [
                'name'      => $request->name
            ];

            Role::where('id', $role->id)->update($data);
            return redirect()->back()->with('msg-success', 'Role updated successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('msg-error', $e);
        }
    }
}
