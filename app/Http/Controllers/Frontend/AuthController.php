<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Notifications\RegistrationEmailNotification;

class AuthController extends Controller
{
    

    public function showLogin(){
        return view('frontend.auth.login');
    }


    public function processLogin(Request $request){
        $validator = Validator::make($request->all(),[
            'email'         =>  'required|email',
            'password'      =>  'required'   
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials  = request()->only(['email','password']);

        if(auth()->attempt($credentials)){
            $user = auth()->user();
            if($user->email_verified_at == null){
                auth()->logout();
                session()->flash('type','danger');
                session()->flash('message','Your account is not activated.');
                return redirect()->route('login');
                
            }
            session()->flash('type','success');
            session()->flash('message','Login Successfully');
            return redirect()->intended();
        }

        session()->flash('type','danger');
        session()->flash('message','email and/or password notmatch');
        return redirect()->route('login');

    }

    public function showRegister(){
        return view('frontend.auth.register');
    }

    public function processRegister(Request $request){

        $validator = Validator::make($request->all(),  [
            'name'          =>  'required',
            'email'         =>  'required|email|unique:users,email',
            'phone_number'  =>  'required|unique:users,phone_number',
            'password'      =>  'required|min:6'

        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name'          =>  $request->name,
                'email'         =>  strtolower($request->email),
                'phone_number'  =>  $request->phone_number,
                'password'      =>  bcrypt($request->password),
                'email_verified_token'  =>  uniqid(time(), true).str_random(16)
            ]);
            
            $user->notify(new RegistrationEmailNotification($user));

            session()->flash('type','success');
            session()->flash('message','Account Registered');
            
            return redirect()->route('login');

         } 
        catch (Exception $e) {
            session()->flash('type','warning');
            session()->flash('message',$e->getMessage());

            return redirect()->back();
        }
    }

    public function activate($token = NULL){
        if($token==NULL){
            return redirect('/');
        }

        $user = User::where('email_verified_token',$token)->firstOrFail();
        
        //dd($user);

        if($user){
            $user->email_verified_at= Carbon::now();
            $user->email_verified_token  = null;

            $user->save();

            session()->flash('type','success');
            session()->flash('message','Account activated. You can login now');

            return redirect()->route('login');
        }

        session()-flash('type','danger');
        session()->flash('message','Invalid token');
        return redirect('/');

    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }


    public function profile(){
        return 'profile';
    }

}
