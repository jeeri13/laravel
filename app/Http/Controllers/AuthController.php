<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
        // if(session()->has('email'))
        // {
        //     return redirect('/showLoginForm');
        // } else {
            
        //     return view('auth.login'); // The view for the login form
        // }
    }
     /**
     * Handle the login form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
// print_r($request->all());exit;

        // if(session()->has('email'))
        // {
        //     return redirect('/');
        // } else {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $email = $request->input('email');
            $password = $request->input('password');

            $credentials = ['email' => $email, 'password' => $password];
            // print_r($credentials);exit;
            $user_data = $this->auth($credentials);
            // $user_data = User::login($credentials);
            // print_r($user_data);exit;

            if ($user_data) {
                // Create a session for the user
                $request->session()->put('email', $user_data->email);
                $request->session()->put('name', $user_data->name);
                $request->session()->put('id', $user_data->id);

                $id = session('id');
                $email = session('email');
                $name = session('name');
                
                return redirect('/simple-ui');
            }

            // Authentication failed; redirect back with an error message
            return back()->withErrors(['email' => 'Invalid credentials']);
        // }
    }
    
    /**
     * 
     */
    public function logout()
    {
        session()->flush();  //session destroy
        session()->regenerate();
        return redirect('/login'); // Redirect to the login page or any other page you prefer

    }
     /**
     * Custom authentication method.
     *
     * @param  array  $credentials
     * @return mixed
     */
    public static function auth($credentials)
    {
        try {
            // Retrieve the user with the given email
            $user = DB::table('users')
                ->where('email', $credentials['email'])
                ->where('password', md5($credentials['password']))
                ->first();
                        
            if ($user) {
                // Authentication successful; return the user object
                return $user;
            }
            // Authentication failed; return null
            return null;
        } catch (\Exception $e) {
            // Handle the exceptions that might occur during the query
            return null;
        }
    }

    /**
     * Custom authentication method.
     *
     * @param  string  $id
     * @return mixed
     */
    public static function getUser($id)
    {
        try {
            // Retrieve the user with the given email
            $user = DB::table('users')
                ->where('id', $id)
                ->first();
                        
            if ($user) {
                // Authentication successful; return the user object
                return $user;
            }
            // Authentication failed; return null
            return null;
        } catch (\Exception $e) {
            // Handle the exceptions that might occur during the query
            return null;
        }
    }
    
}
