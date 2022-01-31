<?php

namespace App\Http\Controllers;

use App\Committee;
use App\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $committees = Committee::with('users')
            ->orderBy('userId', 'asc')
            ->get();

            $admin = Committee::with('users')
            ->where('admin', '=', 1)
            ->where('userId', '=', auth()->id())
            ->count();

        if ($admin != NULL) {
            return view('committees.index', compact('committees'));
        } else {
            return view('committees.committee', compact('committees'));
        }

        
    }

    public function uCommitteeIndex()
    {
        $committees = Committee::with('users')
            ->orderBy('userId', 'asc')
            ->get();

        return view('committees.user', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id = Auth::id();
        $users = User::where('id', '!=', auth()->id())
            ->where('committee', '=', '0')
            ->pluck('name', 'id');
        return view('committees.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $check = DB::table('committees')
            ->where('role', '=', $request->role)
            ->count();

        
        if ($check == 0) {
            Committee::create([
                'userId' => $request->userId,
                'role' => $request->role,
                'assigned_at' =>Carbon::now()
            ]);

            if($request->role == 'Imam' || $request->role =='Pengerusi')
            {
                DB::table('users')
                ->where('id', '=', $request->userId)
                ->update(['committee' => 1]);

                DB::table('committees')
                ->where('userId', '=', $request->userId)
                ->update(['admin' => 1]);
            }else{
                DB::table('users')
                ->where('id', '=', $request->userId)
                ->update(['committee' => 1]);
            }

        
            return redirect()->route('committees.index')
                ->with('success', 'Committee created successfully.');
        }

        else
        {
            return redirect()->route('committees.index')
                ->with('danger', 'The position already taken');
        }
    }

    /**
     * Display the specified resource. 
     *
     * @param  \App\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function show(Committee $committee)
    {
        $user = User::where('id', '=', auth()->id())->first();
        return view('committees.show', compact('committee', 'user'));
    }

    public function showCom(Committee $committee)
    {

        $user = User::where('id', '=', $committee->userId)->first();
        return view('committees.showCom', compact('committee', 'user'));
    }

    public function adminProfile(User $user)
    {
        $committee = Committee::with('users')
        ->where('userId', '=', $user->id)->first();
        //dd($committee->users->name);
        return view('committees.adminProfile', compact('committee', 'user'));
    }

    public function comProfile(Committee $committee)
    {
        $user = User::where('id', '=', auth()->id())->first();
        $committee = Committee::with('users')
        ->where('userId','=',auth()->id())
        ->first();
        return view('committees.comProfile', compact('committee', 'user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $committee = Committee::with('users')
        ->where('userId', '=', auth()->id())->first();
        return view('committees.edit', compact('committee', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Committee $committee)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $committee->update($request->all());

        return redirect()->route('committees.show')
            ->with('success', 'Committee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Committee $committee)
    {
        $committee->delete();

        return redirect()->back()
            ->with('success', 'Committee deleted successfully');
    }
}
