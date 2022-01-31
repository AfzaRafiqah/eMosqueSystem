<?php

namespace App\Http\Controllers;


use App\User;
use Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Event;
use App\Committee;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = User::where('email', $request->email)->first();
            
            $admin = Committee::with('users')
            ->where('admin' ,'=' ,1)
            ->where('userId','=',auth()->id())
            ->count();

            //dd($admin);

            if($admin ==1)
            {
                return redirect()->route('kambing')
                ->with('success','Welcome'.' '.auth()->user()->userName);
            }
            elseif(auth()->user()->committee==1)
            {
                return redirect()->route('committee')
                ->with('success','Welcome'.' '.auth()->user()->userName);
            }
            else
            {
                
                return redirect()->route('user')
                ->with('success','Welcome'.' '.auth()->user()->userName);
            }

           //return Redirect::back()->withErrors("errors")->with($request->email);
            Alert::success('Success Title', 'Success Message');
            $events = Event::whereBetween('startDate', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            return view('user')->with(compact('events'));
            return redirect()->route('user',['events' => $events]); //home
        }
            Alert::success('Success Title', 'Success Message');
            Alert::warning('Password and E-mail Not Match', 'Please enter valid email and password');
            return redirect()->back()
            ->with('warning','Password and E-mail Not Match');
    
        
    }
}
