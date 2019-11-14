<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Client;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (Config::get('end') == 'back') {
            return Validator::make($data, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } else {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:80'],
                'surname' => ['required', 'string', 'max:150'],
                'date-of-birth' => ['required', 'date'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'phone-number' => ['required', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}/i'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (Config::get('constants.end') == 'back') {
            return User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role-id' => 2,
                'remember_token' => Str::random(10),
            ]);
        } else {
            $addresses = Config::get('constants.addresses');
            $addr = $addresses[array_rand($addresses)];

            return Client::create([
                'name'                  => $data['name'],
                'phone-number'          => $data['phone-number'],
                'surname'               => $data['surname'],
                'date-of-birth'         => $data['date-of-birth'],
                'email'                 => $data['email'],
                'password'              => Hash::make($data['password']),
                // Randomly generated data
                'remember_token' => Str::random(10),
                'country'               => $addr['country'],
                'address'               => $addr['address'],
                'trading-account-number'=> rand(1000000, 9999999),
                'balance'               => rand(0, 100000) . '.' . rand(0, 99),
                'open-trades'           => rand(0, 100),
                'close-trades'          => rand(0,1000),
            ]);
        }
    }

    public function showRegistrationForm() {
        if (Config::get('constants.end') == 'back') {
            return view('auth.register');
        } else {
            return view('auth.client-register');
        }
    }
}
