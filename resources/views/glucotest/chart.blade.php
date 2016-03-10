@extends('layouts.app')

@section('content')
<!---for chart-->
<!--script>

    $(document).ready(function () {
// create DatePicker from input HTML element
        $("#datestart").kendoDatePicker({
            format: "yyyy-MM-dd"}
        );
        $("#dateend").kendoDatePicker({
        format: "yyyy-MM-dd"}
        );
              
    });
</script-->
</script>
<script src="{{asset('assets/lib/kendojs/js/kendo.data.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.color.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.drawing.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.dataviz.core.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.pdf.min.js')}}"></script>
<script src="{{asset('assets/lib/kendojs/js/kendo.dataviz.themes.min.js')}}"></script>
<script src="{{asset('assets/lib/kendojs/js/kendo.dataviz.chart.min.js')}}"></script>

<script src="{{asset('assets/lib/kendojs/js/jszip.min.js')}}"></script>
<!--script src="{{asset('assets/lib/kendojs/js/kendo.all.min.js')}}"></script-->

<!-- Bootstrap Boilerplate... -->
<div class="container">
    <!--div class="panel panel-primary">
        <div class="panel-heading">
            Seleziona intervallo date
        </div>
        <div class="panel-body">
            <div class="col-sm-4">
                         Data inizio: <input type="text" name="datestart" id="datestart" class="form-control" >
                    </div>
             <div class="col-sm-4">
                         Data fine: <input type="text" name="dateend" id="dateend" class="form-control" >
                    </div>
              <div class="col-sm-4">
                  <button name="calc" id="calc" class="btn btn-default" >Calcola</button>
                    </div>
        </div>
    </div-->
    <div class="pdf-page">
        <div class="panel panel-primary">
            <div class="panel-heading "> {{ trans('messages.glycemy_trend_chart_last_two_weeks') }}</div>
            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                <!--div class="row">
                    <div class="col col-md-12">
                        <h4>Valori glicemia ultime due settimane</h4>
                    </div>
                </div-->


                <div class="row">
                    <div class="col col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading" style="background-color: white">Valori medi</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col col-md-2 col-xs-2"> Media generale: </div>
                                    <div class="col col-md-10 col-xs-10"> <button class="btn btn-info">{{$avg000}}</button></div>
                                </div>

                                <div class="row">
                                    <div class="col col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-2 col-xs-2">Mattino a digiuno:</div> 
                                    <div class="col col-md-2 col-xs-2"><button class="btn btn-default">{{$avg100}}</button></div>
                                    <div class="col col-md-2 col-xs-2">Prima di pranzo:</div>
                                    <div class="col col-md-2 col-xs-2"><button class="btn btn-default">{{$avg200}}</button></div>
                                    <div class="col col-md-2 col-xs-2">Dopo pranzo:</div>
                                    <div class="col col-md-2 col-xs-2"><button class="btn btn-default">{{$avg300}}</button></div>

                                    <div class="row">
                                        <div class="col col-md-12">&nbsp;</div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col col-md-2 col-xs-2">Prima di cena:</div> 
                                    <div class="col col-md-2 col-xs-2"><button class="btn btn-default">{{$avg400}}</button></div>
                                    <div class="col col-md-2 col-xs-2">Dopo cena:</div>
                                    <div class="col col-md-2 col-xs-2"><button class="btn btn-default">{{$avg500}}</button></div>
                                    <div class="col col-md-2 col-xs-2"></div>
                                    <div class="col col-md-2 col-xs-2"></div>



                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading" style="background-color: white">Valori picco</div>
                            <div class="panel-body">


                                <div class="row">
                                    <div class="col col-md-2 col-xs-2">Valore massimo:</div> 
                                    <div class="col col-md-2 col-xs-2"><button class="btn btn-info">{{$max}}</button></div>
                                    <div class="col col-md-2 col-xs-2">Valore minimo:</div>
                                    <div class="col col-md-2 col-xs-2"><button class="btn btn-info">{{$min}}</button></div>
                                    <div class="col col-md-2 col-xs-2"></div>
                                    <div class="col col-md-2 col-xs-2"></div>



                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-body">

                                <div class="chart-wrapper">
                                    <div id="pieChart" style="width:100%"></div>
                                </div>
                                <!--button type="button" id="btnExportPDFPieChart" class="btn btn-info"><i class="fa fa-file-pdf-o"></i>&nbsp;Esporta in PDF</button-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col col-md-12"><div class="chart-wrapper">
                                    <div id="chart" style="width:100%"></div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <!--button type="button" class="btn btn-info" id="btnExportPDFLineChart"><i class="fa fa-file-pdf-o"></i>&nbsp;Esporta in PDF</button-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<div class="container">
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class="col col-md-9"></div>
                <div class="col col-md-3">
                    <button type="button" onclick="getPDF('.pdf-page')"type="button" class="btn btn-info" id="btnExportPage">
                        <i class="fa fa-file-pdf-o"></i>
                        &nbsp;Esporta pagina in PDF
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>


<style>
    /*
        Use the DejaVu Sans font for display and embedding in the PDF file.
        The standard PDF fonts have no support for Unicode characters.
    */
    .pdf-page {
        font-family: "DejaVu Sans", "Arial", sans-serif;
    }
</style>
<!--KENDO Wrappers and other wrappers-->
<script type="text/javascript">
    function getPDF(selector) {
        kendo.drawing.drawDOM($(selector)).then(function (group) {
            kendo.drawing.pdf.saveAs(group, "ReportGlicemia.pdf");
        });
    }
    /**
     * 
     * For pdf export.
     */
    $("#btnExportPDFLineChart").click(function () {
        $("#chart").getKendoChart().saveAsPDF();
    });

    $("#btnExportPDFPieChart").click(function () {
        $("#pieChart").getKendoChart().saveAsPDF();
    });
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
                text: "Andamento glicemia"
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
                    format: "{0} mg/dl",
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


    function createPieChartTwoWeeks() {
        //console.log('createChartMonth100');
        $("#pieChart").kendoChart({
            dataSource: {
                transport: {
                    read: {
                        url: "/gettestsforchartdatatwoweeks",
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
                text: "Intervallo valori"
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

    $(document).ready(createPieChartTwoWeeks);
    $(document).bind("kendo:skinChange", createPieChartTwoWeeks);
    $(window).on("resize", function () {
        kendo.resize($(".chart-wrapper"));
    });
</script>



<!--END KENDO Wrappers-->

@endsection