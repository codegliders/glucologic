@extends('layouts.app')
@section('content')
<!---for chart-->
<script src="{{asset('assets/lib/kendojs/js/kendo.data.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.color.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.drawing.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.dataviz.core.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.dataviz.themes.min.js')}}"></script>
<script src="{{asset('assets/lib/kendojs/js/kendo.dataviz.chart.min.js')}}"></script>
<script>
  $(function () {
       
       // $("#insertTestButtonDiv").hide();
    });
</script>
<div class="container">

    <br>
    <div class='panel panel-info'>
        <div class="panel-heading">Gestione glicemia</div>
        <div class="panel-body">
            <div class="row">
                <!--div class="col col-md-1">&nbsp;</div-->
                <div class="col col-md-3"> 
                    <form action="/tests">
                        <button class="btn btn-info center-block" type="submit" ><i class="fa fa-bar-chart"></i>&nbsp;Inserisci test glicemico
                        </button> 
                    </form>
                    <br>
                </div>
                <!--div class="col col-md-1"></div-->
                <div class="col col-md-3"> 
                    <form action="/chart">
                        <button class="btn btn-info  center-block"  type="submit" ><i class="fa fa-area-chart">&nbsp;</i>Rapporti
                        </button>
                    </form>
                    <br>
                </div>
                <!--div class="col col-md-1"></div-->
                <div class="col col-md-2"> 
                    <form action="/tasks">
                        <button class="btn btn-info center-block "  type="submit"><i class="fa fa-tasks"></i>&nbsp;Task
                        </button>
                    </form> 
                    <br>
                </div>

            </div>
        </div>
    </div>
    <div class='panel panel-info'>
        <div class="panel-heading">{{ trans('messages.recent_glycemic_avg') }}</div>
        <div class="panel-body">


            <?php if (Auth::check() != false) { ?>  
                <div class="row">
                    <div class="col col-md-1 col-sm-3 col-xs-6">{{ trans('messages.general_avg') }}: </div>
                    <div class="col col-md-1 col-sm-3 col-xs-6">    <button class="btn btn-info" >{{ $avg000 }}</button> </div>

                    <div class="col col-md-1 col-sm-3 col-xs-6">{{ trans('messages.basal') }}: </div>
                    <div class="col col-md-1 col-sm-3 col-xs-6">    <button class="btn btn-default" >{{ $avg100 }}</button></div>

                    <div class="col col-md-1 col-sm-3 col-xs-6">{{ trans('messages.preprand_lunch') }}: </div>
                    <div class="col col-md-1 col-sm-3 col-xs-6">    <button class="btn btn-default">{{ $avg200 }}</button></div>

                    <div class="col col-md-1 col-sm-3 col-xs-6">{{ trans('messages.postprand_lunch') }}: </div>
                    <div class="col col-md-1 col-sm-3 col-xs-6">    <button class="btn btn-default">{{ $avg300 }}</button></div>

                    <div class="col col-md-1 col-sm-3 col-xs-6">{{ trans('messages.preprand_dinner') }}: </div>
                    <div class="col col-md-1 col-sm-3 col-xs-6">    <button class="btn btn-default" >{{ $avg400 }}</button></div>

                    <div class="col col-md-1 col-sm-3 col-xs-6">{{ trans('messages.postprand_dinner') }} </div>
                    <div class="col col-md-1 col-sm-3 col-xs-6">   <button class="btn btn-default">{{ $avg500 }}</button></div>
                </div>   


            <?php } ?>

        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel panel-heading">
            {{ trans('messages.glycemy_trend_chart_last_two_weeks') }}
        </div>

        <div class="panel panel body">
            <div class="row">
                <div class="col col-md-12">
                    <div class="chart-wrapper">
                        <div id="chart" style="width:100%"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<script type="text/javascript">

function createChart() {
    $("#chart").kendoChart({
        dataSource: {
            transport: {
                read: {
                    //  url: "/getchartdata",
                    url: "/getglucochartdatalasttwoweeks",
                    dataType: "json"
                }
            },
            sort: {
                field: "date",
                dir: "asc"
            }
        },
        title: {
            text: "<?php echo trans('messages.glycemy_trend_chart_last_two_weeks') ?>"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "line"
        },
        series: [{
                field: "basal",
                name: "Basale mattino"
            }, {
                field: "preprandial_lunch",
                name: "Prima di pranzo"
            },
            {
                field: "postprandial_lunch",
                name: "Dopo pranzo"
            },
            {
                field: "preprandial_dinner",
                name: "Prima di cena"
            }, {
                field: "postprandial_dinner",
                name: "Dopo cena"
            }],
        categoryAxis: {
            field: "date",
            labels: {
                rotation: -90
            },
            crosshair: {
                visible: true
            }
        },
        valueAxis: {
            labels: {
                format: "N0"
            },
            majorUnit: 300
        },
        tooltip: {
            visible: true,
            shared: true,
            format: "N0"
        }
    });
}

$(document).ready(createChart);
$(document).bind("kendo:skinChange", createChart);

$(window).on("resize", function () {
    kendo.resize($(".chart-wrapper"));
});
</script>
@endsection