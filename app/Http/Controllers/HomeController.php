<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Glucotest;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class HomeController extends Controller {

    public function home(Request $request) {

        if (Auth::check() == true) {
            //general
            $avg000 = Glucotest::where('user_id', '=', $request->user()->id)->avg('glucose_value');
            $avg000 = number_format($avg000, 0);
            //100 basal
            $avg100 = Glucotest::where('user_id', '=', $request->user()->id)->where('sys_test_types_id', '=', '100')->avg('glucose_value');
            $avg100 = number_format($avg100, 0);
            //200 preprandial lunch
            $avg200 = Glucotest::where('user_id', '=', $request->user()->id)->where('sys_test_types_id', '=', '200')->avg('glucose_value');
            $avg200 = number_format($avg200, 0);
            //300 postprandial lunch
            $avg300 = Glucotest::where('user_id', '=', $request->user()->id)->where('sys_test_types_id', '=', '300')->avg('glucose_value');
            $avg300 = number_format($avg300, 0);
            //400 preprandial dinner
            $avg400 = Glucotest::where('user_id', '=', $request->user()->id)->where('sys_test_types_id', '=', '400')->avg('glucose_value');
            $avg400 = number_format($avg400, 0);
            //500 postprandial dinner
            $avg500 = Glucotest::where('user_id', '=', $request->user()->id)->where('sys_test_types_id', '=', '500')->avg('glucose_value');
            $avg500 = number_format($avg500, 0);
            
        } else {
            
            return redirect('/');
        }
        
        return view('home', [

            //averages of the field glucotset

            'avg000' => $avg000,
            'avg100' => $avg100,
            'avg200' => $avg200,
            'avg300' => $avg300,
            'avg400' => $avg400,
            'avg500' => $avg500,
        ]);
    }

}
