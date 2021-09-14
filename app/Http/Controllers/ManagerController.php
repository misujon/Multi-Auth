<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware('manager');
    }

    public function index()
    {
        return view('manager.index');
    }

    public function create()
    {
        $user_roles = Role::where('id', '!=', 1)->where('id', '!=', 2)->pluck('name', 'id');
        return view('manager.create', compact('user_roles'));
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
        $users = User::where('role_id', '!=', 1)->where('id', '!=', 2)->get();
        return view('manager.users', compact('users'));
    }

    public function edit($id)
    {
        $user = User::where('role_id', '!=', 1)->where('id', '!=', 2)->find($id);
        $user_roles = Role::where('id', '!=', 1)->where('id', '!=', 2)->pluck('name', 'id');
        return view('manager.edit', compact('user', 'user_roles'));
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
}
