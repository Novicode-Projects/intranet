<?php

namespace App\Http\Controllers;

use App\Models\User;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->select('*')
            ->get();

        if($users->isEmpty())
            return response()->json(["errors" => ["status" => 400, "message" => 'Nothing found !']], 400);

        return view('admin-auth.inscription')->with('users', $users);
        //return response()->json(["success" => ["status" => 200, "message" => $users]], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=>'required|alpha|max:255',
            'last_name'=>'required|alpha|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|max:255',
        ]);

        if ($validator->errors()->isNotEmpty()) 
            return response()->json(["errors" => ["status" => 400, "message" => $validator->errors()]], 400);

        $user = DB::table('users')
            ->select('email')
            ->where('email', $request->email)
            ->get();

        if($user->isNotEmpty())
            return response()->json(["errors" => ["status" => 400, "message" => 'Email already exists !']], 400);

        User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return redirect()->route('dashboard.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email|max:255',
            'password'=>'required|max:255',
        ]);

        $user = DB::table('users')
            ->select('*')
            ->where('email', $request->email)
            ->first();

        if ($user === NULL) 
            return redirect()->route('user.index');
        
        if ($user->disable !== NULL)
            return redirect()->route('user.index');

        else {
            if (auth()->attempt($request->only('email', 'password'), $request->remember))
                return redirect()->route('dashboard.index');
            else
                return redirect()->route('user.index');
        }
    }

    public function logout()
    {
        auth()->logout();
            return redirect()->route('user.index');
    }

    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function postEmail(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('mail.password-verify', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return redirect()->route('user.index');
    }

    public function resetPassword($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where(['email' => $request->email, 'token' => $request->token])
                            ->first();

        if(!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');

        $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/')->with('message', 'votre mot de passe a bien été mis à jour !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
