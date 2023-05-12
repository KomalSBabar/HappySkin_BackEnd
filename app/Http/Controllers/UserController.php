<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view('user.index')->with(compact('users'));
    }

    public function edit_user($user_id){
   
        $user = User::find($user_id); 
        return view('user.edit',compact('user'));
    }

    public function update_user(Request $request,$user_id){
 
        $check = User::find($user_id);
        
        $check->name = $request['name'];
        $check->email = $request['email'];
        $check->phone_no = $request['phone_no'];
        $check->gender = $request['gender'];
        $check->update();
        return redirect()->route('user.index');
    }

    public function create(){
    
        return view('user.create');
    }

    public function store(Request $request){
        $s = Str::random(5);
        $pwd = Hash::make($s);



  
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'phone_no'=>$request->phone,
                'gender'=>$request->gender,
               'password'=>$pwd,
                'c_password'=>$pwd,
                'admin_password'=>$s,
                'role'=>2,
                
    
            ]; 
       

// return($data);
       


        $user = User::create($data);
        // return($user);
        // $user->notify(new WelcomeEmailNotification());

        if($user){
            return redirect()->route('user.index');
        }else
        {
        return;
        }
    }

    public function login(Request $request){

        // return view('layout.default');
        // return $request->all();


        if(Auth::attempt(['email' => $request->email , 'password' => $request->password])){



            
            $request->session()->put('email',$request['email']);
            print_r('login kaim');

            $user = Auth::user();          
            return view('layout.default');
        
        }else{
            return;
        }
    }

    public function logout(){
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }


   










}
