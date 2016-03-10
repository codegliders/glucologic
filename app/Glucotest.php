<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class Glucotest extends Model {/**
 * The attributes that are mass assignable.
 *
 * @var array
 */

    protected $fillable = ['user_id', 'id', 'glucose_value', 'date', 'time', 'notes', 'sys_test_types_id', 'insulin_value'];

    /**
     * Get the user that owns the test.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function index(Request $request) {
        $food_types = DB::table('food_types')->select('id', 'code', 'description_en', 'description_it')->get();
//for language
        $lang = App::getLocale();

        $user = Auth::user();

//dd($food_types);
        $glucotests = DB::table('glucotests')->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
    }

    public static function getAvgGeneralTwoWeeks() {
        $user = Auth::user();
//$user = $request->user();
        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg000 = 0;
        $avg000 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($prevTwoWeeks, $today))->avg('glucose_value');
        $avg000 = number_format($avg000, 0);

        return $avg000;
    }

    public static function getAvgBasalInterval($startDate, $endDate) {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg100 = 0;
//100 basal
        $avg100 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($startDate, $endDate))->where('sys_test_types_id', '=', '100')->avg('glucose_value');
        $avg100 = number_format($avg100, 0);
        return $avg100;
    }

    public static function getAvgPrePrandialTwoWeeks() {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg200 = 0;
        $avg200 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($prevTwoWeeks, $today))->where('sys_test_types_id', '=', '200')->avg('glucose_value');
        $avg200 = number_format($avg200, 0);
        return $avg200;
    }

    public static function getAvgPostPrandialInterval($startDate, $endDate) {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg300 = 0;
        $avg300 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($startDate, $endDate))->where('sys_test_types_id', '=', '300')->avg('glucose_value');
        $avg300 = number_format($avg300, 0);
        return $avg300;
    }

    public static function getAvgPreDinnerInterval($startDate, $endDate) {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg400 = 0;
//400 preprandial dinner
        $avg400 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($startDate, $endDate))->where('sys_test_types_id', '=', '400')->avg('glucose_value');
        $avg400 = number_format($avg400, 0);
        return $avg400;
    }

    public static function getAvgPostDinnerTwoWeeks() {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

//500 postprandial dinner
        $avg500 = 0;
        $avg500 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($prevTwoWeeks, $today))->where('sys_test_types_id', '=', '500')->avg('glucose_value');
        $avg500 = number_format($avg500, 0);
        return $avg500;
    }

    public static function getMinGlucoseValueTwoWeeks() {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

//500 postprandial dinner

        $min = 0;
        $min = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($prevTwoWeeks, $today))->min('glucose_value');

        return $min;
    }

    public static function getMaxGlucoseValueTwoWeeks() {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

//500 postprandial dinner

        $min = 0;
        $min = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($prevTwoWeeks, $today))->max('glucose_value');

        return $min;
    }

    public static function getAvgGeneralInterval($startDate, $endDate) {
        $user = Auth::user();
//$user = $request->user();
        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg000 = 0;
        $avg000 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($startDate, $endDate))->avg('glucose_value');
        $avg000 = number_format($avg000, 0);

        return $avg000;
    }
    
        public static function getGlycoEmoglobinEstimateInterval($startDate, $endDate) {
        $user = Auth::user();
//$user = $request->user();
        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg000 = 0;
        $avg000 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($startDate, $endDate))->avg('glucose_value');
       // $avg000 = number_format($avg000, 0);
        $emoGlicateEstim=number_format((($avg000 +86)/33.3), 1);

        return $emoGlicateEstim;
    }

    public static function getAvgBasalTwoWeeks() {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg100 = 0;
//100 basal
        $avg100 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($prevTwoWeeks, $today))->where('sys_test_types_id', '=', '100')->avg('glucose_value');
        $avg100 = number_format($avg100, 0);
        return $avg100;
    }

    public static function getAvgPrePrandialInterval($startDate, $endDate) {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg200 = 0;
        $avg200 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($startDate, $endDate))->where('sys_test_types_id', '=', '200')->avg('glucose_value');
        $avg200 = number_format($avg200, 0);
        return $avg200;
    }

    public static function getAvgPostPrandialTwoWeeks() {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg300 = 0;
        $avg300 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($prevTwoWeeks, $today))->where('sys_test_types_id', '=', '300')->avg('glucose_value');
        $avg300 = number_format($avg300, 0);
        return $avg300;
    }

    public static function getAvgPreDinnerTwoWeeks() {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

        $avg400 = 0;
//400 preprandial dinner
        $avg400 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($prevTwoWeeks, $today))->where('sys_test_types_id', '=', '400')->avg('glucose_value');
        $avg400 = number_format($avg400, 0);
        return $avg400;
    }

    public static function getAvgPostDinnerInterval($startDate, $endDate) {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

//500 postprandial dinner
        $avg500 = 0;
        $avg500 = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($startDate, $endDate))->where('sys_test_types_id', '=', '500')->avg('glucose_value');
        $avg500 = number_format($avg500, 0);
        return $avg500;
    }

    public static function getMinGlucoseValueInterval($startDate, $endDate) {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

//500 postprandial dinner

        $min = 0;
        $min = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($startDate, $endDate))->min('glucose_value');

        return $min;
    }

    public static function getMaxGlucoseValueInterval($startDate, $endDate) {
        $user = Auth::user();

        $today = date('Y-m-d');
        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));

//500 postprandial dinner

        $min = 0;
        $min = Glucotest::where('user_id', '=', $user->id)->whereBetween('date', array($startDate, $endDate))->max('glucose_value');

        return $min;
    }

    public static function getLineChartLastTwoWeeks() {
        $user = Auth::user();
        $today = date("Y-m-d");
        $twoWeeksAgo = date('Y-m-d', strtotime("-2 week"));

// error_log($user->id.$today.$twoWeeksAgo);


        $mindate = DB::table('glucotests')->where('user_id', $user->id)->min('date');

// $tests000 = $this->tests->forUser($request->user());

        $tests000 = DB::table('glucotests')->where('user_id', $user->id)->whereBetween('date', array($twoWeeksAgo, $today))->get();


//  dd($tests000);
        $data = array();

        $i = 0;
        $datePrevious = $mindate;
        $user = Auth::user();

        foreach ($tests000 as $test) {

            if (($test->date ) >= ($twoWeeksAgo)) {


                if ($test->date !== $datePrevious && $datePrevious !== null) {

                    $tests100 = DB::table('glucotests')->where('user_id', $user->id)->where('sys_test_types_id', '100')->where('date', $test->date)->get();
                    $tests200 = DB::table('glucotests')->where('user_id', $user->id)->where('sys_test_types_id', '200')->where('date', $test->date)->get();
                    $tests200 = DB::table('glucotests')->where('user_id', $user->id)->where('sys_test_types_id', '200')->where('date', $test->date)->get();
                    $tests300 = DB::table('glucotests')->where('user_id', $user->id)->where('sys_test_types_id', '300')->where('date', $test->date)->get();
                    $tests400 = DB::table('glucotests')->where('user_id', $user->id)->where('sys_test_types_id', '400')->where('date', $test->date)->get();
                    $tests500 = DB::table('glucotests')->where('user_id', $user->id)->where('sys_test_types_id', '500')->where('date', $test->date)->get();

                    $data[$i]['100'] = null;
                    $data[$i]['200'] = null;
                    $data[$i]['300'] = null;
                    $data[$i]['400'] = null;
                    $data[$i]['500'] = null;


                    $data[$i]['date'] = $test->date;

                    error_log($data[$i]['date']);

                    foreach ($tests100 as $test100) {

                        $data[$i]['basal'] = number_format($test100->glucose_value);
                    }
                    foreach ($tests200 as $test200) {

                        $data[$i]['preprandial_lunch'] = number_format($test200->glucose_value);
                    }
                    foreach ($tests300 as $test300) {

                        $data[$i]['postprandial_lunch'] = number_format($test300->glucose_value);
                    }

                    foreach ($tests400 as $test400) {

                        $data[$i]['preprandial_dinner'] = number_format($test400->glucose_value);
                    }
                    foreach ($tests500 as $test500) {

                        $data[$i]['postprandial_dinner'] = number_format($test500->glucose_value);
                    }

                    $i++;
                }



                $datePrevious = $test->date;
            }
        }
//$response=json_encode($data);

        return($data);
    }

    public static function getPieChartDataBasalLastMonth() {
        $today = date("Y-m-d");
        $onemonthago = date('Y-m-d', strtotime("-1 month"));

        $hyponum = 0;
        $normalnum = 0;
        $lighthyper = 0;
        $hyper = 0;
        $user = Auth::user();
//$user = $request->user();
//   $mindate = DB::table('glucotests')->min('date');

        $tests100 = DB::table('glucotests')->where('sys_test_types_id', 100)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
        $count = DB::table('glucotests')->where('sys_test_types_id', 100)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();

        $data = array();

        $i = 0;
// $datePrevious = $mindate;
        $user = Auth::user();

        foreach ($tests100 as $test) {

            if (($test->glucose_value <= 55)) {
                $hyponum++;
            }

            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
                $normalnum++;
            }

            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
                $lighthyper++;
            }

            if (($test->glucose_value > 125)) {
                $hyper++;
            }
        }

        $hypoperc = 0;
        if ($hyponum !== 0 && $count !== 0) {
            $hypoperc = ($hyponum / $count ) * 100;
            $hypoperc = number_format($hypoperc, 0);
        }
        $normalperc = 0;
        if ($normalnum !== 0 && $count !== 0) {
            $normalperc = ( $normalnum / $count) * 100;
            $normalperc = number_format($normalperc, 0);
        }
        $lighthyperperc = 0;
        if ($lighthyper !== 0 && $count !== 0) {
            $lighthyperperc = ($lighthyper / $count) * 100;
            $lighthyperperc = number_format($lighthyperperc, 0);
        }
        $hyperperc = 0;
        if ($hyper !== 0 && $count !== 0) {
            $hyperperc = ($hyper / $count ) * 100;
            $hyperperc = number_format($hyperperc, 0);
        }

        $data[0]['percentage'] = $hypoperc;
        $data[0]['type'] = 'Ipoglicemia';
        $data[1]['percentage'] = $normalperc;
        $data[1]['type'] = 'Valori normali';
        $data[2]['percentage'] = $lighthyperperc;
        $data[2]['type'] = 'Leggera iperglicemia';
        $data[3]['percentage'] = $hyperperc;
        $data[3]['type'] = 'Iperglicemia';

//return (json_encode($data));
        return $data;
    }

//    public static function getPieChartDataForBasalLastWeek() {
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 week"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        // $user = $request->user();
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests100 = DB::table('glucotests')->where('sys_test_types_id', 100)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 100)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests100 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//
//        return $data;
//    }
//
//    public static function getPieChartDataForBasalLastYear() {
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 year"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        // $user = $request->user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests100 = DB::table('glucotests')->where('sys_test_types_id', 100)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 100)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//        error_log('count' . $count);
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        // $user = Auth::user();
//        //$user=$request->user;
//
//        foreach ($tests100 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//
//
//        return $data;
//    }
//
//    public static function getPieChartDataForPrePrandialLastMonth() {
//
////        //prendo la data minima della tabella da utilizzare come variabile iniziale el ciclo
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 month"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests200 = DB::table('glucotests')->where('sys_test_types_id', 200)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 200)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests200 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//        //return (json_encode($data));
//        return $data;
//    }
//
//    public static function getPieChartDataForPrePrandialLastWeek() {
//
////
////        //prendo la data minima della tabella da utilizzare come variabile iniziale el ciclo
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 week"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests200 = DB::table('glucotests')->where('sys_test_types_id', 200)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 200)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests200 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//        //return (json_encode($data));
//        return $data;
//    }
//
//    public static function getPieChartDataForPrePrandialLastYear() {
//
//
//        //prendo la data minima della tabella da utilizzare come variabile iniziale el ciclo
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 year"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests200 = DB::table('glucotests')->where('sys_test_types_id', 200)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 200)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests200 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 200)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//        //return (json_encode($data));
//        return $data;
//    }
//
//    public static function getPieChartDataForPostPrandialLastMonth() {
//
//
////        //prendo la data minima della tabella da utilizzare come variabile iniziale el ciclo
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 month"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests300 = DB::table('glucotests')->where('sys_test_types_id', 300)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 300)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests300 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//        //return (json_encode($data));
//        return $data;
//    }
//
//    public static function getPieChartDataForPostPrandialLastWeek() {
//        //prendo la data minima della tabella da utilizzare come variabile iniziale el ciclo
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 week"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests300 = DB::table('glucotests')->where('sys_test_types_id', 300)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 300)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests300 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//        return $data;
//    }
//
//    public static function getPieChartDataForPostPrandialLastYear() {
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 year"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests300 = DB::table('glucotests')->where('sys_test_types_id', 300)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 300)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests300 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//        //return (json_encode($data));
//        return $data;
//    }
//
//    public static function getPieChartDataForPreDinnerLastMonth() {
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 month"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests400 = DB::table('glucotests')->where('sys_test_types_id', 400)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 400)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//        // error_log('count' . $count);
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests400 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//        return $data;
//    }
//
//    public static function getPieChartDataForPreDinnerLastWeek() {
//        //prendo la data minima della tabella da utilizzare come variabile iniziale el ciclo
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 week"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests400 = DB::table('glucotests')->where('sys_test_types_id', 400)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 400)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//        // error_log('count' . $count);
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests400 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//        return $data;
//    }
//
//    public static function getPieChartDataForPreDinnerLastYear() {
//
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 year"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests400 = DB::table('glucotests')->where('sys_test_types_id', 400)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 400)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//        // error_log('count' . $count);
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests400 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//        return $data;
//    }
//
//    public static function getPieChartDataForPostDinnerLastMonth() {
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 month"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        //$user = $request->user();
//        //   $mindate = DB::table('glucotests')->min('date');
//        $user = Auth::user();
//        $tests500 = DB::table('glucotests')->where('sys_test_types_id', 500)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 500)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//        // error_log('count' . $count);
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//
//
//        foreach ($tests500 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//
//
//        return ($data);
//    }
// public static function getPieChartDataForPostDinnerLastWeek() {
//        $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 week"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests500 = DB::table('glucotests')->where('sys_test_types_id', 500)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 500)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//      //  error_log('count' . $count);
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests500 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//     return $data;
// }
// 
// public static function getPieChartDataForPostDinnerLastYear() {
//         $today = date("Y-m-d");
//        $onemonthago = date('Y-m-d', strtotime("-1 year"));
//
//        $hyponum = 0;
//        $normalnum = 0;
//        $lighthyper = 0;
//        $hyper = 0;
//
//        $user = Auth::user();
//        //   $mindate = DB::table('glucotests')->min('date');
//
//        $tests500 = DB::table('glucotests')->where('sys_test_types_id', 500)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
//        $count = DB::table('glucotests')->where('sys_test_types_id', 500)->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();
//
//        $data = array();
//
//        $i = 0;
//        // $datePrevious = $mindate;
//        $user = Auth::user();
//
//        foreach ($tests500 as $test) {
//
//            if (($test->glucose_value <= 55)) {
//                $hyponum++;
//            }
//
//            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
//                $normalnum++;
//            }
//
//            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
//                $lighthyper++;
//            }
//
//            if (($test->glucose_value > 125)) {
//                $hyper++;
//            }
//        }
//
//        $hypoperc = 0;
//        if ($hyponum !== 0 && $count !== 0) {
//            $hypoperc = ($hyponum / $count ) * 100;
//            $hypoperc = number_format($hypoperc, 0);
//        }
//        $normalperc = 0;
//        if ($normalnum !== 0 && $count !== 0) {
//            $normalperc = ( $normalnum / $count) * 100;
//            $normalperc = number_format($normalperc, 0);
//        }
//        $lighthyperperc = 0;
//        if ($lighthyper !== 0 && $count !== 0) {
//            $lighthyperperc = ($lighthyper / $count) * 100;
//            $lighthyperperc = number_format($lighthyperperc, 0);
//        }
//        $hyperperc = 0;
//        if ($hyper !== 0 && $count !== 0) {
//            $hyperperc = ($hyper / $count ) * 100;
//            $hyperperc = number_format($hyperperc, 0);
//        }
//
//        $data[0]['percentage'] = $hypoperc;
//        $data[0]['type'] = 'Ipoglicemia';
//        $data[1]['percentage'] = $normalperc;
//        $data[1]['type'] = 'Valori normali';
//        $data[2]['percentage'] = $lighthyperperc;
//        $data[2]['type'] = 'Leggera iperglicemia';
//        $data[3]['percentage'] = $hyperperc;
//        $data[3]['type'] = 'Iperglicemia';
//
//     return $data;
// }
    public static function getPieChartDataForTestsLastTwoWeeks() {

        $today = date("Y-m-d");
        $onemonthago = date('Y-m-d', strtotime("-2 week"));

        $hyponum = 0;
        $normalnum = 0;
        $lighthyper = 0;
        $hyper = 0;

        $user = Auth::user();
//   $mindate = DB::table('glucotests')->min('date');

        $tests100 = DB::table('glucotests')->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->get();
        $count = DB::table('glucotests')->whereBetween('date', array($onemonthago, $today))->where('user_id', $user->id)->count();

        $data = array();

        $i = 0;
// $datePrevious = $mindate;
        $user = Auth::user();

        foreach ($tests100 as $test) {

            if (($test->glucose_value <= 55)) {
                $hyponum++;
            }

            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
                $normalnum++;
            }

            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
                $lighthyper++;
            }

            if (($test->glucose_value > 125)) {
                $hyper++;
            }
        }

        $hypoperc = 0;
        if ($hyponum !== 0 && $count !== 0) {
            $hypoperc = ($hyponum / $count ) * 100;
            $hypoperc = number_format($hypoperc, 0);
        }
        $normalperc = 0;
        if ($normalnum !== 0 && $count !== 0) {
            $normalperc = ( $normalnum / $count) * 100;
            $normalperc = number_format($normalperc, 0);
        }
        $lighthyperperc = 0;
        if ($lighthyper !== 0 && $count !== 0) {
            $lighthyperperc = ($lighthyper / $count) * 100;
            $lighthyperperc = number_format($lighthyperperc, 0);
        }
        $hyperperc = 0;
        if ($hyper !== 0 && $count !== 0) {
            $hyperperc = ($hyper / $count ) * 100;
            $hyperperc = number_format($hyperperc, 0);
        }

        $data[0]['percentage'] = $hypoperc;
        $data[0]['type'] = 'Ipoglicemia';
        $data[1]['percentage'] = $normalperc;
        $data[1]['type'] = 'Valori normali';
        $data[2]['percentage'] = $lighthyperperc;
        $data[2]['type'] = 'Leggera iperglicemia';
        $data[3]['percentage'] = $hyperperc;
        $data[3]['type'] = 'Iperglicemia';
        return $data;
    }

    public static function getPieChartDataByPeriodType($period, $type) {
        $today = date("Y-m-d");
        $dtprevious = $period;

        $hyponum = 0;
        $normalnum = 0;
        $lighthyper = 0;
        $hyper = 0;
        $user = Auth::user();
//$user = $request->user();
//   $mindate = DB::table('glucotests')->min('date');

        $tests100 = DB::table('glucotests')->where('sys_test_types_id', $type)->whereBetween('date', array($dtprevious, $today))->where('user_id', $user->id)->get();
        $count = DB::table('glucotests')->where('sys_test_types_id', $type)->whereBetween('date', array($dtprevious, $today))->where('user_id', $user->id)->count();

        $data = array();

        $i = 0;
// $datePrevious = $mindate;
        $user = Auth::user();

        foreach ($tests100 as $test) {

            if (($test->glucose_value <= 55)) {
                $hyponum++;
            }

            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
                $normalnum++;
            }

            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
                $lighthyper++;
            }

            if (($test->glucose_value > 125)) {
                $hyper++;
            }
        }

        $hypoperc = 0;
        if ($hyponum !== 0 && $count !== 0) {
            $hypoperc = ($hyponum / $count ) * 100;
            $hypoperc = number_format($hypoperc, 0);
        }
        $normalperc = 0;
        if ($normalnum !== 0 && $count !== 0) {
            $normalperc = ( $normalnum / $count) * 100;
            $normalperc = number_format($normalperc, 0);
        }
        $lighthyperperc = 0;
        if ($lighthyper !== 0 && $count !== 0) {
            $lighthyperperc = ($lighthyper / $count) * 100;
            $lighthyperperc = number_format($lighthyperperc, 0);
        }
        $hyperperc = 0;
        if ($hyper !== 0 && $count !== 0) {
            $hyperperc = ($hyper / $count ) * 100;
            $hyperperc = number_format($hyperperc, 0);
        }

        $data[0]['percentage'] = $hypoperc;
        $data[0]['type'] = 'Ipoglicemia';
        $data[1]['percentage'] = $normalperc;
        $data[1]['type'] = 'Valori normali';
        $data[2]['percentage'] = $lighthyperperc;
        $data[2]['type'] = 'Leggera iperglicemia';
        $data[3]['percentage'] = $hyperperc;
        $data[3]['type'] = 'Iperglicemia';

//return (json_encode($data));
        return $data;
    }

    public static function getPieChartDataForTestsInterval(Request $request=null, $startDate=null,$endDate=null) {
      //  error_log("hhhh".$startDate,$endDate);

        $today = date("Y-m-d");
        $onemonthago = date('Y-m-d', strtotime("-2 week"));

        $hyponum = 0;
        $normalnum = 0;
        $lighthyper = 0;
        $hyper = 0;

        $user = Auth::user();
//   $mindate = DB::table('glucotests')->min('date');

        $tests100 = DB::table('glucotests')->whereBetween('date', array($startDate, $endDate))->where('user_id', $user->id)->get();
        $count = DB::table('glucotests')->whereBetween('date', array($startDate, $endDate))->where('user_id', $user->id)->count();

        $data = array();

        $i = 0;
// $datePrevious = $mindate;
        $user = Auth::user();

        foreach ($tests100 as $test) {

            if (($test->glucose_value <= 55)) {
                $hyponum++;
            }

            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
                $normalnum++;
            }

            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
                $lighthyper++;
            }

            if (($test->glucose_value > 125)) {
                $hyper++;
            }
        }

        $hypoperc = 0;
        if ($hyponum !== 0 && $count !== 0) {
            $hypoperc = ($hyponum / $count ) * 100;
            $hypoperc = number_format($hypoperc, 0);
        }
        $normalperc = 0;
        if ($normalnum !== 0 && $count !== 0) {
            $normalperc = ( $normalnum / $count) * 100;
            $normalperc = number_format($normalperc, 0);
        }
        $lighthyperperc = 0;
        if ($lighthyper !== 0 && $count !== 0) {
            $lighthyperperc = ($lighthyper / $count) * 100;
            $lighthyperperc = number_format($lighthyperperc, 0);
        }
        $hyperperc = 0;
        if ($hyper !== 0 && $count !== 0) {
            $hyperperc = ($hyper / $count ) * 100;
            $hyperperc = number_format($hyperperc, 0);
        }

        $data[0]['percentage'] = $hypoperc;
        $data[0]['type'] = 'Ipoglicemia';
        $data[1]['percentage'] = $normalperc;
        $data[1]['type'] = 'Valori normali';
        $data[2]['percentage'] = $lighthyperperc;
        $data[2]['type'] = 'Leggera iperglicemia';
        $data[3]['percentage'] = $hyperperc;
        $data[3]['type'] = 'Iperglicemia';
        return $data;
    }

   /** public static function getPieChartDataByPeriodType($period, $type) {
        $today = date("Y-m-d");
        $dtprevious = $period;

        $hyponum = 0;
        $normalnum = 0;
        $lighthyper = 0;
        $hyper = 0;
        $user = Auth::user();
//$user = $request->user();
//   $mindate = DB::table('glucotests')->min('date');

        $tests100 = DB::table('glucotests')->where('sys_test_types_id', $type)->whereBetween('date', array($dtprevious, $today))->where('user_id', $user->id)->get();
        $count = DB::table('glucotests')->where('sys_test_types_id', $type)->whereBetween('date', array($dtprevious, $today))->where('user_id', $user->id)->count();

        $data = array();

        $i = 0;
// $datePrevious = $mindate;
        $user = Auth::user();

        foreach ($tests100 as $test) {

            if (($test->glucose_value <= 55)) {
                $hyponum++;
            }

            if (($test->glucose_value > 55) && ($test->glucose_value < 100)) {
                $normalnum++;
            }

            if (($test->glucose_value >= 100) && ($test->glucose_value <= 125)) {
                $lighthyper++;
            }

            if (($test->glucose_value > 125)) {
                $hyper++;
            }
        }

        $hypoperc = 0;
        if ($hyponum !== 0 && $count !== 0) {
            $hypoperc = ($hyponum / $count ) * 100;
            $hypoperc = number_format($hypoperc, 0);
        }
        $normalperc = 0;
        if ($normalnum !== 0 && $count !== 0) {
            $normalperc = ( $normalnum / $count) * 100;
            $normalperc = number_format($normalperc, 0);
        }
        $lighthyperperc = 0;
        if ($lighthyper !== 0 && $count !== 0) {
            $lighthyperperc = ($lighthyper / $count) * 100;
            $lighthyperperc = number_format($lighthyperperc, 0);
        }
        $hyperperc = 0;
        if ($hyper !== 0 && $count !== 0) {
            $hyperperc = ($hyper / $count ) * 100;
            $hyperperc = number_format($hyperperc, 0);
        }

        $data[0]['percentage'] = $hypoperc;
        $data[0]['type'] = 'Ipoglicemia';
        $data[1]['percentage'] = $normalperc;
        $data[1]['type'] = 'Valori normali';
        $data[2]['percentage'] = $lighthyperperc;
        $data[2]['type'] = 'Leggera iperglicemia';
        $data[3]['percentage'] = $hyperperc;
        $data[3]['type'] = 'Iperglicemia';

//return (json_encode($data));
        return $data;
    }
**/
}
