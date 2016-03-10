@extends('layouts.app')


@section('content')


<!-- for grid
kendo.data.js 	
kendo.columnsorter.js 	
kendo.calendar.js 	Editing feature
kendo.popup.js 	Editing feature
kendo.datepicker.js 	Editing feature
kendo.userevents.js 	Editing feature
kendo.numerictextbox.js 	Editing feature
kendo.validator.js 	Editing feature
kendo.binder.js 	Editing feature
kendo.editable.js 	Editing feature
kendo.draganddrop.js 	Editing feature
kendo.window.js 	Editing feature
kendo.calendar.js 	Filtering feature
kendo.popup.js 	Filtering feature
kendo.datepicker.js 	Filtering feature
kendo.userevents.js 	Filtering feature
kendo.numerictextbox.js 	Filtering feature
kendo.list.js 	Filtering feature
kendo.dropdownlist.js 	Filtering feature
kendo.binder.js 	Filtering feature
kendo.filtermenu.js 	Filtering feature
kendo.popup.js 	Column menu feature
kendo.calendar.js 	Column menu feature
kendo.datepicker.js 	Column menu feature
kendo.userevents.js 	Column menu feature
kendo.numerictextbox.js 	Column menu feature
kendo.list.js 	Column menu feature
kendo.dropdownlist.js 	Column menu feature
kendo.binder.js 	Column menu feature
kendo.filtermenu.js 	Column menu feature
kendo.menu.js 	Column menu feature
kendo.columnmenu.js 	Column menu feature
kendo.userevents.js 	Grouping feature
kendo.draganddrop.js 	Grouping feature
kendo.groupable.js 	Grouping feature
kendo.popup.js 	Row filter feature
kendo.list.js 	Row filter feature
kendo.autocomplete.js 	Row filter feature
kendo.filtercell.js 	Row filter feature
kendo.pager.js 	Paging Feature
kendo.userevents.js 	Selection Feature
kendo.selectable.js 	Selection Feature
kendo.userevents.js 	Column reordering feature
kendo.draganddrop.js 	Column reordering feature
kendo.reorderable.js 	Column reordering feature
kendo.userevents.js 	Column resizing feature
kendo.draganddrop.js 	Column resizing feature
kendo.resizable.js 	Column resizing feature
kendo.popup.js 	Grid adaptive rendering feature
kendo.fx.js 	Grid adaptive rendering feature
kendo.userevents.js 	Grid adaptive rendering feature
kendo.draganddrop.js 	Grid adaptive rendering feature
kendo.mobile.scroller.js 	Grid adaptive rendering feature
kendo.binder.js 	Grid adaptive rendering feature
kendo.view.js 	Grid adaptive rendering feature
kendo.mobile.view.js 	Grid adaptive rendering feature
kendo.mobile.loader.js 	Grid adaptive rendering feature
kendo.mobile.pane.js 	Grid adaptive rendering feature
kendo.mobile.popover.js 	Grid adaptive rendering feature
kendo.mobile.shim.js 	Grid adaptive rendering feature
kendo.mobile.actionsheet.js 	Grid adaptive rendering feature
kendo.ooxml.js 	Excel export feature
kendo.excel.js 	Excel export feature
kendo.color.js 	PDF export feature
kendo.drawing.js 	PDF export feature
kendo.pdf.js 	PDF export feature
kendo.progressbar.js 	PDF export feature

-->

<script src="{{asset('assets/lib/kendojs/js/kendo.data.min.js')}}"></script> 

<script src="{{asset('assets/lib/kendojs/js/kendo.columnsorter.min.js')}}"></script> 	

<!--script src="{{asset('assets/lib/kendojs/js/kendo.datepicker.min.js')}}"></script--> 
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.numerictextbox.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/kendo.validator.min.js')}}"></script>
<script src="{{asset('assets/lib/kendojs/js/kendo.binder.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.editable.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/kendo.draganddrop.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/kendo.window.min.js')}}"></script> 	
<!--script src="{{asset('assets/lib/kendojs/js/kendo.calendar.min.js')}}"></script--> 	
<!--script src="{{asset('assets/lib/kendojs/js/kendo.popup.min.js')}}"></script--> 	
<!--script src="{{asset('assets/lib/kendojs/js/kendo.datepicker.min.js')}}"></script--> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.numerictextbox.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/kendo.list.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.dropdownlist.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.binder.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.filtermenu.min.js')}}"></script> 	
<!--script src="{{asset('assets/lib/kendojs/js/kendo.popup.min.js')}}"></script--> 	
<!--script src="{{asset('assets/lib/kendojs/js/kendo.calendar.min.js')}}"></script--> 	
<!--script src="{{asset('assets/lib/kendojs/js/kendo.datepicker.min.js')}}"></script--> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.numerictextbox.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.list.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.dropdownlist.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/kendo.binder.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.filtermenu.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.menu.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.columnmenu.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/kendo.draganddrop.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.groupable.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/kendo.popup.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.list.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.autocomplete.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.filtercell.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.pager.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.selectable.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.draganddrop.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.reorderable.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.draganddrop.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.resizable.min.js')}}"></script> 	
<!--script src="{{asset('assets/lib/kendojs/js/kendo.popup.min.js')}}"></script--> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.fx.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.userevents.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.draganddrop.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.mobile.scroller.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.binder.min.js')}}"></script>	
<script src="{{asset('assets/lib/kendojs/js/kendo.view.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.mobile.view.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.mobile.loader.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.mobile.pane.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.mobile.popover.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.mobile.shim.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.mobile.actionsheet.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.ooxml.min.js')}}"></script>	
<script src="{{asset('assets/lib/kendojs/js/kendo.excel.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/kendo.color.min.js')}}"></script> 	
<script src="{{asset('assets/lib/kendojs/js/kendo.drawing.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/kendo.pdf.min.js')}}"></script>
<script src="{{asset('assets/lib/kendojs/js/kendo.progressbar.min.js')}}"></script>

<script src="{{asset('assets/lib/kendojs/js/kendo.button.min.js')}}"></script>
<script src="{{asset('assets/lib/kendojs/js/jszip.min.js')}}"></script>
<script src="{{asset('assets/lib/kendojs/js/kendo.grid.min.js')}}"></script> 
<script src="{{asset('assets/lib/kendojs/js/messages/kendo.messages.it-IT.min.js')}}"></script>

<!-- Bootstrap Boilerplate... -->
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading "> {{ trans('messages.glycemy_all_my_values') }}</div>
        <div class="panel-body">
            <!--button id="btnExport">Esporta exce</button-->
            <div class="panel panel-info">
                <div class="panel-heading">Esporta i tuoi valori in Excel e PDF</div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <div class="row">
                        <div class="col col-md-12"><div class="chart-wrapper">
                                <div id="grid"></div>
                            </div></div>

                    </div>

                </div>
            </div>


        </div>


        <!--KENDO Wrappers and other wrappers-->

    </div>
</div>
<style>
    .k-pdf-export .k-grid-toolbar,
    .k-pdf-export .k-pager-wrap
    {
        display: none;
    }
</style>
<script>

$("#btnExport").kendoButton({
    click: function ()
    {
        $("#grid").data("kendoGrid").saveAsExcel()
    }
})
$(document).ready(function () {
    $("#grid").kendoGrid({
        toolbar: ["excel", "pdf"],
        pdf: {
            fileName: "ValoriGlicemici.pdf",
            allPages: true,
            proxyUrl: "/getreportall"
        },
        excel: {
            fileName: "ValoriGlicemici.xlsx",
            allPages:true
        },
        dataSource: {
            type: "json",
            contentType: "application/json; charset=utf-8",
            type: "GET",
                    transport: {
                        read: "/getreportall",
                        parameterMap: function (data, type) {
                            if (type == "read") {
                                // send take as "$top" and skip as "$skip"
                                return {
                                    take: data.take,
                                    skip: data.skip,
                                    sort: data.sort,
                                    filter: data.filter,
                                }
                            }
                        }

                    },
            schema: {
                data: "data", // records are returned in the "data" field of the response

                total: "total", //total record count records is in the "total" field of the response
//                data: function (result) {
//                    return result.data;
//                },
//                total: function (result) {
//                    
//                    return result.total ;
//                },
                model: {
                    fields: {
                        id: {type: "number"},
                        insulin_value: {type: "number"},
                        glucose_value: {type: "number"},
                        date: {type: "date"},
                        time: {type: "string"},
                        description_it: {type: "string"},
//                                     
                    }
                }
            },
            pageSize: 15,
            serverPaging: true,
            serverFiltering: false,
            serverSorting: true
        },
        height: 550,
        filterable: false,
        sortable: true,
        pageable: true,
        columns: [
            {
                field: "date",
                title: "Data",
                format: "{0:dd/MM/yyyy}",
                filterable:{
                               extra: false,
                               ui: 'datepicker'
                           }
//                //format: "{yyyy-mm-dd}",

            },
            {
                field: "time",
                title: "Ora",
                sortable: true
            },
            {
                
                field: "description_it",
                title: "Periodo",
                sortable: true,
               
                //filterable: true
                filterable:{
                            extra: false,
                            operators: {
                                string: {
                                    startswith: "Inizia con",
                                    eq: "E' uguale a",
                                    neq: "Non è uguale a"
                                }
                            }
                        }
            },
            {
                field: "glucose_value",
                title: "Glicemia",
                filterable: false
            },
            {
                field: "insulin_value",
                title: "Insulina",
                filterable: false
            }, ]
    });

});
</script>

<!--END KENDO Wrappers-->

@endsection