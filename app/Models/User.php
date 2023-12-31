<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception; // Import the Exception class if you intend to use it later

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function login($credentials)
    {
        try {
            $user = DB::table('users')->where('email', $credentials['email'])->where('email', md5($credentials['password']))->first();

            if ($user) {
                return $user;
            }

            return null;
        } catch (\Exception $e) {
            // Handle the exception
            Log::error('Error during user login: ' . $e->getMessage());
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
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
            return null;
        }
    }
}
