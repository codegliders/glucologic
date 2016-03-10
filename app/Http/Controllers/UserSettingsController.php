<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Illuminate\Foundation\Auth\ThrottlesLogins;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
class UserSettingsController extends Controller{

    public function __construct() {
       $this->middleware('auth');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'lastname' => 'required|max:255',
                    'firstname' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                        //'password' => 'required|confirmed|min:4',
        ]);
    }

    public function index(Request $request) {

        //for language
        $lang = App::getLocale();

        $user = Auth::user();


        // Glucotest::index();

        return view('settings.usersettings', [
            'user' => $user,
            'lang' => $lang,
        ]);
    }

    public function update(Request $request) {
          $lang = App::getLocale();
        $user = Auth::user();
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        //$user->email=$data['email'];
        $user->save();
  return view('settings.usersettings', [
            'user' => $user,
            'lang' => $lang,
        ]);

//          return User::update([
//            'firstname' => $data['firstname'],
//             'lastname' => $data['lastname'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//        ]);
    }

}
