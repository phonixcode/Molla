<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::getUsers();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($request->password);

        return (User::create($data))
            ? redirect()->route('user.index')->with('success', 'User successfully created')
            : back()->with('errors', 'Error creating user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $user = User::where('uuid', $uuid)->withCount('orders', 'completedOrders')->firstOrFail();
        //return $user;
        return $user
            ? view('admin.user.show', compact('user'))
            : back()->with('error', 'User not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return $user
            ? view('admin.user.edit', compact('user'))
            : back()->with('error', 'User not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user) {
            $this->validate($request, [
                'full_name' => 'string|required',
                'username' => 'string|nullable',
                'email' => 'email|required|exists:users,email',
                'phone' => 'string|nullable',
                'photo' => 'required',
                'address' => 'string|nullable',
                'role' => 'required|in:admin,customer,seller',
                'status' => 'required|in:active,inactive',
            ]);

            $data = $request->all();

            return ($user->fill($data)->save())
                ? redirect()->route('user.index')->with('success', 'User successfully updated')
                : back()->with('errors', 'Error updating user');
        } else {
            return back()->with('error', 'Date not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user) {
            return $user->delete()
                ? redirect()->route('user.index')->with('success', 'User deleted successfully')
                : back()->with('error', 'Something went wrong');
        } else {
            return back()->with('error', 'Date not found');
        }
    }
}
