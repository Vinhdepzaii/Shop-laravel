<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],
        [
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]
        );
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role_id == 6 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8 || Auth::user()->role_id == 9){
                return redirect()->route('admin.dashboard');
            }
            if(Session::has('previous_url')){
                $url = Session::get('previous_url');
                Session::forget('previous_url');
                return Redirect::to($url);
            }
            return redirect()->route('fe.home.index');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                if(Session::has('previous_url')){
                    $url = Session::get('previous_url');
                    Session::forget('previous_url');
                    return Redirect::to($url);
                }
                return redirect()->intended('/');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy'),
                    'role_id' => '10',
                    'status' => 'active',
                ]);
                Auth::login($newUser);
                if(Session::has('previous_url')){
                    $url = Session::get('previous_url');
                    Session::forget('previous_url');
                    return Redirect::to($url);
                }
                return redirect()->intended('/');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('fe.home.index');
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback() {
        try {
            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('/');

            }else{
                $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'facebook_id'=> $user->id,
                'password' => encrypt('123456'),
                'type' => 'user',
            ]);

                Auth::login($newUser);

                return redirect()->intended('/');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function registerForm()
    {
        return view('auth.register');
    }
    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ],
[
            'name.required' => 'Tên không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
            'password_confirmation.same' => 'Xác nhận mật khẩu không đúng',
        ]
        );
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['type'] = 'user';
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('fe.home.index');
    }
}
