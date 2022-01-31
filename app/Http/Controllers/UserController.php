<?php

namespace App\Http\Controllers;

use App\User;
use App\Committee;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('committee', '=', 0)
            ->get();

        return view('users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (auth()->user()->committee == 1) {
            return view('users.show', compact('user'));
        } else {
            return view('users.profile', compact('user'));
        }
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {


        $admin = Committee::with('users')
            ->where('admin', '=', 1)
            ->where('userId', '=', auth()->id())
            ->count();

        if ($admin != NULL) {
            return view('committees.edit', compact('user'));
        } elseif (auth()->user()->committee == 1) {
            return view('users.editCom', compact('user'));
        } elseif (auth()->user()->committee == 0) {
            return view('users.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        if (auth()->user()->committee == 1) {
            return redirect()->route('committees.comProfile', auth()->id())
                ->with('success', 'User updated successfully');
        } else {
            return view('users.profile', compact('user'))
                ->with('success', 'User updated successfully');
        }
    }

    public function updateCom(Request $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('committees.adminProfile', Auth::user()->id)
            ->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
