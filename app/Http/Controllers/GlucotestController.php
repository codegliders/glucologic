<?php

namespace App\Http\Controllers;

use App;
use DB;
use App\Glucotest;
use App\InsulinTypes;
use Auth;
use App\User;
//use Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GlucotestRepository;

class GlucotestController extends Controller {

    /**
     * The test repository instance.
     *
     * @var GlucotestRepository
     */
    protected $tests;

    /**
     * Create a new controller instance.
     *
     * @param GlucotestRepository $tests    
     * @return void
     */
    public function __construct(GlucotestRepository $glucotests) {
        $this->middleware('auth');
        $this->tests = $glucotests;
    }

    /**
     * Display a list of all of the user's tests.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        // for food type select
        $food_types = DB::table('food_types')->select('id', 'code', 'description_en', 'description_it')->get();
        //for language
        $lang = App::getLocale();

        $user = Auth::user();

        //dd($food_types);
        $glucotests = DB::table('glucotests')->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        // Glucotest::index();

        return view('glucotest.index', [
            'glucotests' => $glucotests,
            'food_types' => $food_types,
            'lang' => $lang,
        ]);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'name.required' => 'A title is required',
            'glucose_value' => 'A message is required',
        ];
    }

    /**
     * Create a new test.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'glucose_value' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
        ]);
        $request->user()->glucotests()->create([
            'glucose_value' => $request->glucose_value,
            'insulin_value' => $request->insulin_value,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            'sys_test_types_id' => $request->sys_test_types_id,
        ]);
        return redirect('/generalreporttests');
    }

    /**
     * Destroy the given test.
     *
     * @param Request $request
     * @param Glucotest $test
     * @return Response
     */
    //public function destroy(Request $request, Glucotest $test) {
    // public function destroy($test,Request $request, Glucotest $glucotest) {
    public function destroy($test, Request $request, Glucotest $glucotest) {
        //dd($test);
        //DB::table('glucotests')->where('id', $test)->delete();
         $glucotest->destroy($test);
       // $glucotests=$this->tests->forUser($request->user())->paginate(10);
        // dd($glucotests);
        //return json_encode($glucotests);
        //return redirect('/tests');
    }

    /**
     * Display report by interval
     */
    public function getReportByInterval(Request $request, $dateStart = null, $dateEnd = null) {
        //dd($request);
        // Glucotest::getLineChartTwoWeeks($request);
//        $user = Auth::user();
//
//        $today = date('Y-m-d');
//        $prevTwoWeeks = date('Y-m-d', strtotime("-2 week"));
        $avg000 = 0;
        $avg100 = 0;
        $avg200 = 0;
        $avg300 = 0;
        $avg400 = 0;
        $avg500 = 0;
        $min = 0;
        $max = 0;
        $data=null;
        $emoglicateestim=0;
           $emobtnclass='btn btn-success';
        if ($dateEnd !== null && $dateStart !== null) {
            $avg000 = Glucotest::getAvgGeneralInterval($dateStart, $dateEnd);
            $avg100 = Glucotest::getAvgBasalInterval($dateStart, $dateEnd);
            $avg200 = Glucotest::getAvgPrePrandialInterval($dateStart, $dateEnd);
            $avg300 = Glucotest::getAvgPostPrandialInterval($dateStart, $dateEnd);
            $avg400 = Glucotest::getAvgPreDinnerInterval($dateStart, $dateEnd);
            $avg500 = Glucotest::getAvgPostDinnerInterval($dateStart, $dateEnd);
            $min = Glucotest::getMinGlucoseValueInterval($dateStart, $dateEnd);
            $max = Glucotest::getMaxGlucoseValueInterval($dateStart, $dateEnd);
          //   $data = Glucotest::getPieChartDataForTestsInterval($dateStart, $dateEnd);
        }


        return view('glucotest.reportbyinterval', [
            //  'glucotests' => $this->tests->forUser($request->user()),
            'avg000' => $avg000,
            'avg100' => $avg100,
            'avg200' => $avg200,
            'avg300' => $avg300,
            'avg400' => $avg400,
            'avg500' => $avg500,
            'max' => $max,
            'min' => $min,
            'emobtnclass'=>$emobtnclass,
            'emoglicateestim'=>$emoglicateestim,
               'dateStart'=> $dateStart,
            'dateEnd'=> $dateEnd,
              //  'data'=>$data
        ]);
    }

    /**
     * Display report by interval
     */
    public function reportByInterval(Request $request, $dateStart = null, $dateEnd = null) {

         $dateEnd=null;
        $dateStart=null;
        $dateStart=$request->input("dateStart");
        $dateEnd=$request->input("dateEnd");
        $avg000 = 0;
        $avg100 = 0;
        $avg200 = 0;
        $avg300 = 0;
        $avg400 = 0;
        $avg500 = 0;
        $min = 0;
        $max = 0;
          $emobtnclass='btn btn-success';
        if ($dateEnd !== null && $dateStart !== null) {
            $avg000 = Glucotest::getAvgGeneralInterval($dateStart, $dateEnd);
            $avg100 = Glucotest::getAvgBasalInterval($dateStart, $dateEnd);
            $avg200 = Glucotest::getAvgPrePrandialInterval($dateStart, $dateEnd);
            $avg300 = Glucotest::getAvgPostPrandialInterval($dateStart, $dateEnd);
            $avg400 = Glucotest::getAvgPreDinnerInterval($dateStart, $dateEnd);
            $avg500 = Glucotest::getAvgPostDinnerInterval($dateStart, $dateEnd);
            $min = Glucotest::getMinGlucoseValueInterval($dateStart, $dateEnd);
            $max = Glucotest::getMaxGlucoseValueInterval($dateStart, $dateEnd);
            $emoglycate=Glucotest::getGlycoEmoglobinEstimateInterval($dateStart, $dateEnd);
         
            if($emoglycate>6){
                 $emobtnclass='btn btn-warning';
            }
           // $data = Glucotest::getPieChartDataForTestsInterval($request,  $dateStart, $dateEnd);
        }


        return view('glucotest.reportbyinterval', [
            //  'glucotests' => $this->tests->forUser($request->user()),
            'avg000' => $avg000,
            'avg100' => $avg100,
            'avg200' => $avg200,
            'avg300' => $avg300,
            'avg400' => $avg400,
            'avg500' => $avg500,
            'max' => $max,
            'min' => $min,
            'emoglicateestim'=>$emoglycate,
            'emobtnclass'=>$emobtnclass,
            'dateStart'=> $dateStart,
            'dateEnd'=> $dateEnd,
               // 'data'=>$data
        
        ]);
    }

    /**
     * Display a chart.
     *
     * @param Request $request
     * @return Response
     */
    public function chart(Request $request) {
 
        $avg000 = Glucotest::getAvgGeneralTwoWeeks();
        $avg100 = Glucotest::getAvgBasalTwoWeeks();
        $avg200 = Glucotest::getAvgPrePrandialTwoWeeks();
        $avg300 = Glucotest::getAvgPostPrandialTwoWeeks();
        $avg400 = Glucotest::getAvgPreDinnerTwoWeeks();
        $avg500 = Glucotest::getAvgPostDinnerTwoWeeks();
        $min = Glucotest::getMinGlucoseValueTwoWeeks();
        $max = Glucotest::getMaxGlucoseValueTwoWeeks();



        return view('glucotest.chart', [
            //  'glucotests' => $this->tests->forUser($request->user()),
            'avg000' => $avg000,
            'avg100' => $avg100,
            'avg200' => $avg200,
            'avg300' => $avg300,
            'avg400' => $avg400,
            'avg500' => $avg500,
            'max' => $max,
            'min' => $min,
        ]);
    }

    /**
     * Get Chart data.
     *
     * @param Request $request
     * @return Response
     */
    public function getChartData(Request $request) {

//
//        //prendo la data minima della tabella da utilizzare come variabile iniziale el ciclo
        $mindate = DB::table('glucotests')->min('date');

        $tests000 = $this->tests->forUser($request->user());


        $data = array();

        $i = 0;
        $datePrevious = $mindate;
        $user = Auth::user();

        foreach ($tests000 as $test) {

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
        //$response=json_encode($data);

        return($data);
    }

    /**
     * Get Chart data for last two weeks.
     *
     * @param Request $request
     * @return Response
     */
    public function getChartDataByDayLastTwoWeeks() {
        $data = Glucotest::getLineChartLastTwoWeeks();
        return($data);
    }

    function edit(Request $request, $id) {

        $test = DB::table('glucotests')->where('id', $id)->get();
        //dd($test);
        $selectedcode = $test[0]->sys_test_types_id;
        $time = $test[0]->time;
        // dd($selectedid);
        $test_types = DB::table('sys_test_types')->select('id', 'code', 'description_en', 'description_it')->get();
        // dd($test);
        return view('glucotest.edittest', compact('test', 'time', 'test_types', 'selectedcode'));
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'glucose_value' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
        ]);
        DB::table('glucotests')->where('id', $id)->update([
            'glucose_value' => $request->glucose_value,
            'insulin_value' => $request->insulin_value,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            'sys_test_types_id' => $request->sys_test_types_id,
        ]);
        return redirect('/generalreporttests');
    }

    /*
     * In THEORY for Kendo Datagrid.
     * Did not manage to get datagrid working in view.
     */

    public function getReportAll(Request $request, $take = null, $skip = null, $pagesize = null) {


        $user = Auth::user();
        $take = $request->take;
        $skip = $request->skip;
        $filter = $request->filter;


        $i = 0;
        $serviceFilters = array();
        $wherestring = "";
        if ($request->filter) {

            $filterLogic = $filter['logic'];
            $filterArray = $filter['filters'];

            $operators = array(
                'eq' => '=',
                'gt' => '>',
                'gte' => '>=',
                'lt' => '<',
                'lte' => '<=',
                'neq' => '!='
            );

            foreach ($filterArray as $filter) {

                switch ($filter['operator']) {
                    case "eq":
                        $serviceFilters[$i]['operator'] = '=';
                        $serviceFilters[$i]['value'] = $filter['value'];
                        break;
                    case "neq":
                        $serviceFilters[$i]['operator'] = '!=';
                        $serviceFilters[$i]['value'] = $filter['value'];
                        break;
                    case "startswith":
                        $serviceFilters[$i]['operator'] = 'LIKE';
                        $serviceFilters[$i]['value'] = $filter['value'] . "%";
                        break;
                    case "endswith":
                        $serviceFilters[$i]['operator'] = 'LIKE';
                        $serviceFilters[$i]['value'] = "%" . $filter['value'];
                        break;
                    case "contains":
                        $serviceFilters[$i]['operator'] = 'LIKE';
                        $serviceFilters[$i]['value'] = "%" . $filter['value'] . "%";
                        break;
                    case "lte":
                        $serviceFilters[$i]['operator'] = '<=';
                        $serviceFilters[$i]['value'] = $filter['value'];
                        break;
                    case "gte":
                        $serviceFilters[$i]['operator'] = '>=';
                        $serviceFilters[$i]['value'] = $filter['value'];
                        break;
                    case "gt":
                        $serviceFilters[$i]['operator'] = '>';
                        $serviceFilters[$i]['value'] = $filter['value'];
                        break;
                    case "lt":
                        $serviceFilters[$i]['operator'] = '<';
                        $serviceFilters[$i]['value'] = $filter['value'];
                        break;
                }
                $serviceFilters[$i]['field'] = $filter['field'];

                $i++;
            }

            $i = 0;
            foreach ($serviceFilters as $sFilter) {
                $datevalidity = $this->checkIsAValidDate($sFilter['value']);
                if ($datevalidity) {
                    $date = $sFilter['value'];
                    $datets = strtotime($date);
                    $new_date = date('Y-m-d', $datets);

                    $serviceFilters[$i]['value'] = "date('" . $new_date . "')";
                } else {
                    $serviceFilters[$i]['value'] = "'" . $sFilter['value'] . "'";
                }
                $i++;
            }


            $wherestring = " AND ";
            $whereArray = array();
            $i = 0;

            foreach ($serviceFilters as $sFilter) {
                $len = count($serviceFilters) - 1;
                $field = $sFilter['field'];
                $op = $sFilter['operator'];
                $val = $sFilter['value'];
//                $whereArray[$i]['field']=$field;
//                $whereArray[$i]['op']=$op;
//                $whereArray[$i]['val']=''.$val.'';
                $wherestring.=$field . ' ' . $op . ' ' . $val . ' ';
                if ($i !== $len) {
                    $wherestring.=' AND ';
                }
                $i++;
            }
        }



        if ($request->sort) {
            $sort = array();
            $sort = $request->sort;
            $sortField = $request->sort[0]['field'];
            $sortDir = $request->sort[0]['dir'];
        }

        if ($request->sort) {
            $sort = array();
            $sort = $request->sort;
            $sortField = $request->sort[0]['field'];
            $sortDir = $request->sort[0]['dir'];
            $tests = DB::table('glucotests')
                    ->leftJoin('sys_test_types', 'glucotests.sys_test_types_id', '=', 'sys_test_types.code')
                   // ->select('glucotests.*', 'sys_test_types.code', 'sys_test_types.description_it as testTypeDesc ')
                     ->select('glucotests.*', 'sys_test_types.code', 'sys_test_types.description_it')
                    ->where('user_id', $user->id)
                    ->skip($skip)
                    ->take($take)
                    ->orderBy($sortField, $sortDir)
                    ->get();
        } else {
            //      $tests = DB::select('select glucotests.*, sys_test_types.code,sys_test_types.description_it '
//                            . 'from glucotests left join sys_test_types on sys_test_types.code=glucotests.sys_test_types_id'
//                            . ' where glucotests.user_id=' . $user->id . $wherestring);
            $tests = DB::table('glucotests')
                            ->leftJoin('sys_test_types', 'glucotests.sys_test_types_id', '=', 'sys_test_types.code')
                            ->select('glucotests.*', 'sys_test_types.code', 'sys_test_types.description_it')
                            ->where('user_id', $user->id)
                            ->skip($skip)
                            ->take($take)
                            ->orderBy('created_at', 'DESC')->get();
        }
        $total = DB::table('glucotests')->where('user_id', $user->id)->count();
//       $total= DB::select('select count(*)'
//                            . 'from glucotests left join sys_test_types on sys_test_types.code=glucotests.sys_test_types_id'
//                            . ' where glucotests.user_id=' . $user->id . $wherestring);

        $ass_array = array();
        $ass_array['data'] = $tests;
        $ass_array['total'] = $total;


        //return $tests;
        return $ass_array;
    }

    public function checkIsAValidDate($myDateString) {
        return (bool) strtotime($myDateString);
    }

    public function reportAll() {
        return view('glucotest.report_all');
    }

    public function generalReportTests(Request $request) {
        $user = Auth::user();
        $glucotests = DB::table('glucotests')->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('glucotest.generalreport', compact('glucotests'));
    }

    /**
     * To delete
     */
//    public function getPieChartDataForTestTypes100LastMonth(Request $request) {
//
//        $data = Glucotest::getPieChartDataBasalLastMonth($request);
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes100LastWeek(Request $request) {
//
//        $data = Glucotest::getPieChartDataForBasalLastWeek();
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes200LastYear(Request $request) {
//
//        $data = Glucotest::getPieChartDataForPrePrandialLastYear();
//        return $data;
//    }
//
//    /**
//     * Get Chart data for last two weeks.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function getPieChartDataForTestTypes200LastMonth(Request $request) {
//        $data = Glucotest::getPieChartDataForPrePrandialLastMonth();
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes200LastWeek(Request $request) {
//
//        $data = Glucotest::getPieChartDataForPrePrandialLastWeek();
//
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes300LastYear(Request $request) {
//        $data = Glucotest::getPieChartDataForPostPrandialLastYear();
//        return $data;
//    }
//
//    /**
//     * Get Chart data for last two weeks.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function getPieChartDataForTestTypes300LastMonth(Request $request) {
//
//        $data = Glucotest::getPieChartDataForPostPrandialLastMonth();
//
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes300LastWeek(Request $request) {
//
//        $data = Glucotest::getPieChartDataForPostPrandialLastWeek();
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes500LastYear(Request $request) {
//
//        $data = Glucotest::getPieChartDataForPostDinnerLastYear();
//        return $data;
//    }
//
//    /**
//     * Get Chart data for last two weeks.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function getPieChartDataForTestTypes500LastMonth(Request $request) {
//        $data = Glucotest::getPieChartDataForPostDinnerLastMonth();
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes500LastWeek(Request $request) {
//
//        $data = Glucotest::getPieChartDataForPostDinnerLastWeek();
//
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes400LastYear(Request $request) {
//
//        $data = Glucotest::getPieChartDataForPreDinnerLastYear();
//
//        return $data;
//    }
//
//    /**
//     * Get Chart data for last two weeks.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function getPieChartDataForTestTypes400LastMonth(Request $request) {
//
//        $data = Glucotest::getPieChartDataForPreDinnerLastMonth();
//
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes400LastWeek(Request $request) {
//
//        $data = Glucotest::getPieChartDataForPreDinnerLastWeek();
//
//        return $data;
//    }
//
//    public function getPieChartDataForTestTypes100LastYear(Request $request) {
//
//        $data = Glucotest::getPieChartDataForBasalLastYear();
//
//        return $data;
//    }
//
//    
    /*
     * generic pie by periodtype
     */
    public function getPieChartDataByPeriodType($period, $type, Request $request) {

        $data = Glucotest::getPieChartDataByPeriodType($period, $type);

        return $data;
    }

    /**
     * Display a chart.
     *
     * @param Request $request
     * @return Response
     */
    public function pieChartsByTestType(Request $request) {
        return view('glucotest.piesbytesttype', [
                // 'glucotests' => $this->tests->forUser($request->user()),
        ]);
    }

    public function getPieChartDataTestsLastTwoWeeks(Request $request) {

        $data = Glucotest::getPieChartDataForTestsLastTwoWeeks();
        return $data;
    }
    
      public function getPieChartDataTestsInterval( $dateStart=null,$dateEnd=null,Request $request=null) {
          
         // $startDate= $request->input('dateStart');
          // $endDate= $request->input('dateEnd');
           
    

        $data = Glucotest::getPieChartDataForTestsInterval($request,$dateStart,$dateEnd);
        return $data;
    }

}
