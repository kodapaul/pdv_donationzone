<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests\LoginRules;
use App\Http\Requests\RegisterRules;
use App\Models\User;
use PDOException;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('visit');
    }

    //Get Statements
    public function login(LoginRules $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('dashboard');
            } else {
                return back()->with('login_error', 'Your email and password does not match our records');
            }
        } catch (PDOException $e) {
            return 'Something went Wrong Code 500';
        }
    }

    public function register(RegisterRules $request)
    {
        DB::beginTransaction();
        try {
            $user = new Users();
            $user = $user->create_user($request);
            DB::commit();
            Auth::login($user);
            return redirect()->route('dashboard');
        } catch (PDOException $e) {
            DB::rollback();
            return 'Something went Wrong Code 500';
        }
    }

    //Post Statements
    public function login_page()
    {
        return view('login');
    }

    public function registration_page()
    {
        return view('registration');
    }
}
