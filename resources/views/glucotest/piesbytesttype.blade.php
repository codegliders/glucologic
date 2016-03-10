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


<!--script src="{{asset('assets/lib/kendojs/js/kendo.all.min.js')}}"></script-->
<!-- Bootstrap Boilerplate... -->
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading "> Prove glicemiche mattino a digiuno</div>
        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <div class="row">
                <div class="col col-md-12"><div class="chart-wrapper">
                        <div class="row">
                            <div id="chart100Year" class="col col-md-4" ></div>
                            <div id="chart100Month" class="col col-md-4" ></div>
                            <div id="chart100Week" class="col col-md-4" ></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading ">Prove glicemiche prima di pranzo</div>
        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <div class="row">
                <div class="col col-md-12"><div class="chart-wrapper">
                        <div class="row">
                            <div id="chart200Year" class="col col-md-4" ></div>
                            <div id="chart200Month" class="col col-md-4" ></div>
                            <div id="chart200Week" class="col col-md-4" ></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading ">Prove glicemiche dopo pranzo</div>
        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <div class="row">
                <div class="col col-md-12"><div class="chart-wrapper">
                        <div class="row">
                            <div id="chart300Year" class="col col-md-4" ></div>
                            <div id="chart300Month" class="col col-md-4" ></div>
                            <div id="chart300Week" class="col col-md-4" ></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading ">Prove glicemiche prima di cena</div>
        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <div class="row">
                <div class="col col-md-12"><div class="chart-wrapper">
                        <div class="row">
                            <div id="chart400Year" class="col col-md-4" ></div>
                            <div id="chart400Month" class="col col-md-4" ></div>
                            <div id="chart400Week" class="col col-md-4" ></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
        <div class="panel panel-primary">
        <div class="panel-heading ">Prove glicemiche dopo cena</div>
        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <div class="row">
                <div class="col col-md-12"><div class="chart-wrapper">
                        <div class="row">
                            <div id="chart500Year" class="col col-md-4" ></div>
                            <div id="chart500Month" class="col col-md-4" ></div>
                            <div id="chart500Week" class="col col-md-4" ></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    
function createChartYear100() {
    //create today and previousyear dates to snd to transport
    var date=new Date();

     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var onebefore=(date.getFullYear()-1) + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var testtype='100';
     
    //console.log('createChartYear100');
    $("#chart100Year").kendoChart({
        dataSource: {
            transport: {
                read: {
                    url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Mattino a digiuno ultimo anno"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

//function createChartYear100() {
//    //create today date
//    
//    //console.log('createChartYear100');
//    $("#chart100Year").kendoChart({
//        dataSource: {
//            transport: {
//                read: {
//                    url: "/getchartdatabytesttype100year",
//                    dataType: "json"
//                }
//            },
//            filter: {
//                // field: "year", operator: "eq", value: year
//            },
//            sort: {
////                field: "year",
////                dir: "asc"
//            }
//        },
//        title: {
//            text: "Mattino a digiuno ultimo anno"
//        },
//        legend: {
//            position: "top"
//        },
//        seriesDefaults: {
//            type: "pie",
//            labels: {
//                visible: true,
//                background: "transparent",
//                template: "#= category #: \n #= value#%"
//            }
//        },
//        series: [{
//                type: "pie",
//                field: "percentage",
//                categoryField: "type", }],
//        tooltip: {
//            visible: true,
//            format: "N0",
//            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
//        }
//    });
//}
$(document).ready(createChartYear100);
$(document).bind("kendo:skinChange", createChartYear100);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

//for month basal
function createChartMonth100() {
//     var date=new Date();
//
//   var onebefore;
//     if(date.getMonth()==0){
//          onebefore=(date.getFullYear()-1)+ '-' + (date.getMonth()+12) + "-"+ date.getDate();
//     } else{
//           onebefore=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     }
      //MOMENT:JS
     
     //var now=moment();
     onebefore=moment().subtract(1, 'month').format('YYYY-MM-DD');
     var testtype='100';
    $("#chart100Month").kendoChart({
        dataSource: {
            transport: {
                read: {
                    url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Mattino a digiuno queste mese"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartMonth100);
$(document).bind("kendo:skinChange", createChartMonth100);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

function createChartWeek100() {
//      var date=new Date();
//      var date1=new Date();
//        date1.setDate(date.getDate() -7);
//       //date1.setMonth(date.getMonth()-1)
//     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     
//     var onebefore=(date.getFullYear()) + '-' + (date.getMonth()+1) + "-"+ (date1.getDate());
//     
//     //MOMENT:JS
//     
//     var now=moment();
     var onebefore=moment().subtract(7, 'day').format('YYYY-MM-DD');
     var testtype='100';
    console.log(onebefore);
    $("#chart100Week").kendoChart({
        dataSource: {
            transport: {
                read: {
                    url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Mattino a digiuno questa settimana"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartWeek100);
$(document).bind("kendo:skinChange", createChartWeek100);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

function createChartYear200() {
      var date=new Date();

     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var onebefore=(date.getFullYear()-1) + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var testtype='200';
    //console.log('createChartYear200');
    $("#chart200Year").kendoChart({
        dataSource: {
            transport: {
                read: {
                    url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Prima di pranzo ultimo anno"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartYear200);
$(document).bind("kendo:skinChange", createChartYear200);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

//for month basal
function createChartMonth200() {
//      var date=new Date();
//    var onebefore;
//     if(date.getMonth()==0){
//          onebefore=(date.getFullYear()-1)+ '-' + (date.getMonth()+12) + "-"+ date.getDate();
//     } else{
//           onebefore=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     }
     
      onebefore=moment().subtract(1, 'month').format('YYYY-MM-DD');
     var testtype='200';
    $("#chart200Month").kendoChart({
        dataSource: {
            transport: {
                read: {
                    url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Prima di pranzo questo mese"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartMonth200);
$(document).bind("kendo:skinChange", createChartMonth200);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

function createChartWeek200() {
//         var date=new Date();
//      var date1=new Date();
//        date1.setDate(date.getDate() -7);
//       date1.setMonth(date.getMonth()-1)
//     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     
//     var onebefore=(date.getFullYear()) + '-' + (date.getMonth()+1) + "-"+ (date1.getDate());
//      //MOMENT:JS
//     
//     var now=moment();
    var onebefore=moment().subtract(7, 'day').format('YYYY-MM-DD');
        var testtype='200';
    //console.log('createChartMonth200');
    $("#chart200Week").kendoChart({
        dataSource: {
            transport: {
                read: {
                   url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Prima di pranzo questa settimana"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartWeek200);
$(document).bind("kendo:skinChange", createChartWeek200);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

function createChartYear300() {
    //console.log('createChartYear300');
      var date=new Date();

     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var onebefore=(date.getFullYear()-1) + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var testtype='300';
    $("#chart300Year").kendoChart({
        dataSource: {
            transport: {
                read: {
                     url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Dopo pranzo ultimo anno"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartYear300);
$(document).bind("kendo:skinChange", createChartYear300);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

//for month basal
function createChartMonth300() {
//      var date=new Date();
//   var onebefore;
//     if(date.getMonth()==0){
//          onebefore=(date.getFullYear()-1)+ '-' + (date.getMonth()+12) + "-"+ date.getDate();
//     } else{
//           onebefore=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     }
       onebefore=moment().subtract(1, 'month').format('YYYY-MM-DD');
     var testtype='300';
    $("#chart300Month").kendoChart({
        dataSource: {
            transport: {
                read: {
                   url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Dopo pranzo queste mese"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartMonth300);
$(document).bind("kendo:skinChange", createChartMonth300);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

function createChartWeek300() {
//       var date=new Date();
//      var date1=new Date();
//        date1.setDate(date.getDate() -7);
//       date1.setMonth(date.getMonth()-1)
//     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     
//     var onebefore=(date.getFullYear()) + '-' + (date.getMonth()+1) + "-"+ (date1.getDate());
//     
//      //MOMENT:JS
//     
//     var now=moment();
     var onebefore=moment().subtract(7, 'day').format('YYYY-MM-DD');
        var testtype='300';
    //console.log('createChartMonth300');
    $("#chart300Week").kendoChart({
        dataSource: {
            transport: {
                read: {
                     url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Dopo pranzo questa settimana"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartWeek300);
$(document).bind("kendo:skinChange", createChartWeek300);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

function createChartYear400() {
      var date=new Date();

     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var onebefore=(date.getFullYear()-1) + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var testtype='400';
    //console.log('createChartYear400');
    $("#chart400Year").kendoChart({
        dataSource: {
            transport: {
                read: {
                     url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Prima di cena ultimo anno"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartYear400);
$(document).bind("kendo:skinChange", createChartYear400);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

//for month basal
function createChartMonth400() {
//      var date=new Date();
//    var onebefore;
//     if(date.getMonth()==0){
//          onebefore=(date.getFullYear()-1)+ '-' + (date.getMonth()+12) + "-"+ date.getDate();
//     } else{
//           onebefore=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     }
       onebefore=moment().subtract(1, 'month').format('YYYY-MM-DD');
     var testtype='400';
    $("#chart400Month").kendoChart({
        dataSource: {
            transport: {
                read: {
                      url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Prima di cena queste mese"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartMonth400);
$(document).bind("kendo:skinChange", createChartMonth400);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

function createChartWeek400() {
//       var date=new Date();
//      var date1=new Date();
//        date1.setDate(date.getDate() -7);
//       date1.setMonth(date.getMonth()-1)
//     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     
//     var onebefore=(date.getFullYear()) + '-' + (date.getMonth()+1) + "-"+ (date1.getDate());
     
      //MOMENT:JS
     
     //var now=moment();
     var onebefore=moment().subtract(7, 'day').format('YYYY-MM-DD');
        var testtype='400';
    //console.log('createChartMonth400');
    $("#chart400Week").kendoChart({
        dataSource: {
            transport: {
                read: {
                       url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Prima di cena questa settimana"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartWeek400);
$(document).bind("kendo:skinChange", createChartWeek400);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});
function createChartYear500() {
      var date=new Date();

     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var onebefore=(date.getFullYear()-1) + '-' + (date.getMonth()+1) + "-"+ date.getDate();
     var testtype='500';
    //console.log('createChartYear500');
    $("#chart500Year").kendoChart({
        dataSource: {
            transport: {
                read: {
                   url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Dopo cena ultimo anno"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartYear500);
$(document).bind("kendo:skinChange", createChartYear500);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

//for month basal
function createChartMonth500() {
//      var date=new Date();
//     var onebefore;
//     if(date.getMonth()==0){
//          onebefore=(date.getFullYear()-1)+ '-' + (date.getMonth()+12) + "-"+ date.getDate();
//     } else{
//           onebefore=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     }
       onebefore=moment().subtract(1, 'month').format('YYYY-MM-DD');
     var testtype='500';
    $("#chart500Month").kendoChart({
        dataSource: {
            transport: {
                read: {
                      url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Dopo cena queste mese"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartMonth500);
$(document).bind("kendo:skinChange", createChartMonth500);
//$(window).on("resize", function () {
//    kendo.resize($(".chart-wrapper"));
//});

function createChartWeek500() {
//       var date=new Date();
//      var date1=new Date();
//        date1.setDate(date.getDate() -7);
//       date1.setMonth(date.getMonth()-1)
//     var today=date.getFullYear() + '-' + (date.getMonth()+1) + "-"+ date.getDate();
//     
//     var onebefore=(date.getFullYear()) + '-' + (date.getMonth()+1) + "-"+ (date1.getDate());
//     
      //MOMENT:JS
     
   
     onebefore=moment().subtract(7, 'day').format('YYYY-MM-DD');
        var testtype='500';
    //console.log('createChartMonth500');
    $("#chart500Week").kendoChart({
        dataSource: {
            transport: {
                read: {
                       url: "/piechartbyperiodtype/"+onebefore+"/"+testtype,
                    dataType: "json"
                }
            },
            filter: {
                // field: "year", operator: "eq", value: year
            },
            sort: {
//                field: "year",
//                dir: "asc"
            }
        },
        title: {
            text: "Dopo cena questa settimana"
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            type: "pie",
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#%"
            }
        },
        series: [{
                type: "pie",
                field: "percentage",
                categoryField: "type", }],
        tooltip: {
            visible: true,
            format: "N0",
            template: "#= category # - #= kendo.format('{0:P}', percentage)#"
        }
    });
}

$(document).ready(createChartWeek500);
$(document).bind("kendo:skinChange", createChartWeek500);





//resize window - leave only one cal for all
$(window).on("resize", function () {
    kendo.resize($(".chart-wrapper"));
});

</script>
<!--KENDO Wrappers and other wrappers-->
<!--script type="text/javascript">
    
    function createChart() {
        $("#chart").kendoChart({
            dataSource: {
                transport: {
                    read: {
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
    $(window).on("resize", function() {
      kendo.resize($(".chart-wrapper"));
    });
</script-->

<!--END KENDO Wrappers-->

@endsection