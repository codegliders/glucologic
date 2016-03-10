@extends('layouts.app')

@section('content')
<!--script src="{{asset('assets/lib/kendojs/js/kendo.all.min.js')}}"></script-->
<script type="text/javascript">

    kendo.culture("it-IT");

    var today = new Date();
    var month = today.getMonth() + 1;
    var day = today.getDate();
    var year = today.getFullYear();
    var hour = today.getHours();
    var mins = today.getMinutes()
    date = year + "-" + month + "-" + day;
    time = hour + ":" + mins;
    if (hour.toString().length < 2) {
        hour = "0" + hour;
    }
    // console.log(time);
    $(function () {
        $("#date").val(date);
        var options = $('#time option');


        //select time based on minutes value

        if (mins > 15 && mins <= 45) {
            $("#time").val(hour + ":30");
        } else if (mins > 45 && mins <= 59) {
            if (hour < 23) {
                $("#time").val((hour + 1) + ":00");
            } else {
                $("#time").val("00:00");
            }
        } else if (mins >= 00 && mins <= 15) {
            $("#time").val(hour + ":00");

        }

        $("#insertTestButtonDiv").hide();
    });

</script>
<!-- Bootstrap Boilerplate... -->
<div class="container">

    <div class="panel panel-info">
        <div class="panel-heading "><?php echo trans('messages.insert_glucose_test'); ?></div>
        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New Test Form -->
            <form action="/test" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <!-- Glucotest inputs -->
                <div class="form-group">
                    <label for="date" class="col-sm-3 control-label"><?php echo trans('messages.date'); ?></label>

                    <div class="col-sm-6">
                        <input type="text" name="date" id="date" class="form-control" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="time" class="col-sm-3 control-label"><?php echo trans('messages.time'); ?></label>

                    <div class="col-sm-2">
                        <!--input type="text" name="time" id="time" class="form-control"-->
                        <!-- kendo timepicker does not work properly in android without kendo.all.min.js-
                        - using a select for the moment-->
                        <select class="form-control" name="time" id="time">
                            <?php
                            for ($i = 0; $i < 24; $i++) {
                                if ($i < 10) {
                                    echo '<option value="0' . $i . ':00">0' . $i . ':00</option>';
                                    echo '<option value="0' . $i . ':30">0' . $i . ':30</option>';
                                } else {
                                    echo '<option value="' . $i . ':00">' . $i . ':00</option>';
                                    echo '<option value="' . $i . ':30">' . $i . ':30</option>';
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="glucose_value" class="col-sm-3 control-label"><?php echo trans('messages.glucose_value'); ?></label>

                    <div class="col-sm-2 col-md-2">
                        <input type="number" name="glucose_value" id="glucose_value" class="form-control">
                        <!--div class="fuelux">
                            <div class="spinbox"  id="glucose_value_spinbox"  id="glucose_value_1"  name="glucose_value_1" >
                                <input type="text" id="glucose_value"  name="glucose_value" class="form-control input-mini spinbox-input">
                                <div class="spinbox-buttons btn-group btn-group-vertical">
                                    <button type="button" class="btn btn-default spinbox-up btn-xs">
                                        <span class="glyphicon glyphicon-chevron-up"></span><span class="sr-only"><?php echo trans('messages.increase'); ?></span>
                                    </button>
                                    <button type="button" class="btn btn-default spinbox-down btn-xs">
                                        <span class="glyphicon glyphicon-chevron-down"></span><span class="sr-only"><?php echo trans('messages.decrease'); ?></span>
                                    </button>
                                </div>
                            </div>
                        </div-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="sys_test_types_id" class="col-sm-3 control-label"><?php echo trans('messages.test_type'); ?></label>

                    <div class="col-sm-3">
                        <select name="sys_test_types_id" class="form-control" id="sys_test_values">
                            <option value="100"><?php echo trans('messages.basal'); ?></option>
                            <option value="200"><?php echo trans('messages.preprand_lunch'); ?></option>
                            <option value="300"><?php echo trans('messages.postprand_lunch'); ?></option>
                            <option value="400"><?php echo trans('messages.preprand_dinner'); ?></option>
                            <option value="500"><?php echo trans('messages.postprand_dinner'); ?></option>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label for="glucose_value" class="col-sm-3 control-label"><?php echo trans('messages.insulin_value'); ?></label>

                    <div class="col-sm-2 col-md-2">
                        <input type="number" id="insulin_value"  name="insulin_value" class="form-control input-mini spinbox-input">
                        <!--div class="fuelux">
                            <div class="spinbox"  id="insulin_value_spinbox"  id="insulin_value_1"  name="insulin__value_1" >
                                <input type="text" id="insulin_value"  name="insulin_value" class="form-control input-mini spinbox-input">
                                <div class="spinbox-buttons btn-group btn-group-vertical">
                                    <button type="button" class="btn btn-default spinbox-up btn-xs">
                                        <span class="glyphicon glyphicon-chevron-up"></span><span class="sr-only"><?php echo trans('messages.increase'); ?></span>
                                    </button>
                                    <button type="button" class="btn btn-default spinbox-down btn-xs">
                                        <span class="glyphicon glyphicon-chevron-down"></span><span class="sr-only"><?php echo trans('messages.decrease'); ?></span>
                                    </button>
                                </div>
                            </div>
                        </div-->
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes" class="col-sm-3 control-label">Note</label>

                    <div class="col-sm-6">
                        <input type="textarea" name="notes" id="notes" class="form-control">
                    </div>
                </div>
                <!-- Add test Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-info">
                            <i class="fa fa-plus"></i> <?php echo trans('messages.save_test_btn'); ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Current Glucotest -->
    @if (count($glucotests) > 0)
    <!--div class="panel panel-default">
        <div class="panel-heading">
    <?php echo trans('messages.glycemy_all_my_values'); ?>
        </div>

        <div class="panel-body">
         
            <div class="pagination"> 

                <ul class="pagination">
                    @if ($glucotests->currentPage()=='1')
                    <li class="disabled"><span>&laquo;</span></li>
                    @else
                    <li><a href="{{ $glucotests->previousPageUrl()}}"> &laquo; &nbsp;Pagina precedente</a></li> 
                    @endif


                    @if ($glucotests->currentPage()==$glucotests->lastPage())
                    <li class="disabled"><span>&raquo;</span></li>
                    @else
                    <li><a href="{{$glucotests->nextPageUrl()}}"> Pagina seguente &nbsp;&raquo;</a></li>
                    @endif
                    <li  class="disabled"><span> Pagina {{$glucotests->currentPage()}} di {{$glucotests->lastPage()}} </span></li> 
                    <li  class="disabled"><span > Totale test: {{$glucotests->total()}}</span></li> 
                </ul>
            </div>
           

            <div class="table-responsive">
                <table class="table table-striped test-table" id="tests_table">

                  
                    
                    <thead>
                    <th><?php echo trans('messages.glucose_value'); ?></th>
                    <th><?php echo trans('messages.date'); ?></th>
                    <th><?php echo trans('messages.time'); ?></th>
                    <th><?php echo trans('messages.test_type'); ?></th>
                    <th><?php echo trans('messages.insulin_value'); ?></th>
                    <th><?php echo trans('messages.notes'); ?></th>

                    </thead>


                   
                    
                    <tbody id="tests_table_body">
                        @foreach ($glucotests as $test)
                        <tr>   
                            <td class="table-text">
                                <div>
                                    @if ($test->glucose_value >='100')
                                    @if ($test->glucose_value <='125')
                                    <span class='fa fa-bar-chart' style='color:#ffad33'></span>
                                    @else
                                    <span class='fa fa-bar-chart' style='color:#ff471a'></span>
                                    @endif

                                    @elseif(($test->glucose_value >'55'))

                                    @if(($test->glucose_value <'100'))
                                    <span class='fa fa-bar-chart' style='color:green'></span>
                                    @endif



                                    @else($test->glucose_value <'55')

                                    <span class='fa fa-bell' style='color:#ff471a'></span>
                                    @endif

                                    {{ $test->glucose_value }}

                                </div>
                            </td>

                            <td class="table-text">
                                <div>{{ $test->date }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $test->time }}</div>
                            </td>

                            <td class="table-text">
                                <div>
                                    @if ($test->post_prandial === '1')
                                    <div class="center-block">
                                        <span class="fa fa-apple fa-lg" style="color:#ffad33"></span> 
                                    </div>

                                    @else

                                    @endif


                                </div>

                                <div>
                                    @if ($test->sys_test_types_id === '100')
                                    <div class="center-block">
                                        <span class="fa fa-apple fa-lg" style="color:#00ace6"></span> <?php echo trans('messages.basal'); ?>
                                    </div>

                                    @elseIf ($test->sys_test_types_id === '200')
                                    <div class="center-block">
                                        <span class="fa fa-apple fa-lg" style="color:#33cc33"></span> <?php echo trans('messages.preprand_lunch'); ?>
                                    </div>

                                    @elseIf ($test->sys_test_types_id === '300')
                                    <div class="center-block">
                                        <span class="fa fa-apple fa-lg" style="color:#ffad33"></span> <?php echo trans('messages.postprand_lunch'); ?>
                                    </div>
                                    @elseIf ($test->sys_test_types_id === '400')
                                    <div class="center-block">
                                        <span class="fa fa-apple fa-lg" style="color:#33cc33"></span> <?php echo trans('messages.preprand_dinner'); ?>
                                    </div>
                                    @elseIf ($test->sys_test_types_id === '500')
                                    <div class="center-block">
                                        <span class="fa fa-apple fa-lg" style="color:#ffad33"></span> <?php echo trans('messages.postprand_dinner'); ?>
                                    </div>
                                    @endif


                                </div>
                            </td>
                            <td class="table-text">
                                <div>
                                    @if($test->insulin_value!='0')
                                    {{ $test->insulin_value }}
                                    @endif
                                </div>
                            </td>
                            <td class="table-text">
                                <div>{{ $test->notes }}</div>
                            </td>
                            <td class="table-text">
                                <div>
                                    <form action="/edittest/{{ $test->id }}" method="POST">
                                        {{ csrf_field() }}


                                        <button class="btn btn-warning"><?php echo trans('messages.edit_test'); ?></button>
                                    </form>
                                </div>
                            </td>
                            <td class="table-text">
                                <div>
                                    <form id="frm_del_{{$test->id}}" action="/test/{{ $test->id }}"  method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger"  data-id="{{ $test->id }}"><?php echo trans('messages.delete_test'); ?></button>
                                    </form>
                                </div>
                            </td>

                            <td>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="pagination"> 

                <ul class="pagination">
                    @if ($glucotests->currentPage()=='1')
                    <li class="disabled"><span>&laquo;</span></li>
                    @else
                    <li><a href="{{ $glucotests->previousPageUrl()}}"> &laquo; &nbsp;Pagina precedente</a></li> 
                    @endif


                    @if ($glucotests->currentPage()==$glucotests->lastPage())
                    <li class="disabled"><span>&raquo;</span></li>
                    @else
                    <li><a href="{{$glucotests->nextPageUrl()}}"> Pagina seguente &nbsp;&raquo;</a></li>
                    @endif
                    <li  class="disabled"><span> Pagina {{$glucotests->currentPage()}} di {{$glucotests->lastPage()}} </span></li> 
                    <li  class="disabled"><span > Totale test: {{$glucotests->total()}}</span></li> 
                </ul>
            </div>
      
            
        </div>

    </div-->
</div>

<!--KENDO Wrappers and other wrappers-->
<script>


    $(document).ready(function () {
    // create DatePicker from input HTML element
    $("#date").kendoDatePicker({
    format: "yyyy-MM-dd"}
    );

  /*  $('#tests_table .btn-danger').css('border', '1px solid red').click(function (e) {
        e.preventDefault();
        id = $(this).attr('data-id');
        var dlbuttonmgs
        var msg = confirm('Are you sure you want to delete this?')
        if (msg) {
             $.get('test/' + id, function (data) {
            data = JSON.parse(data);
            $('#tests_table_body').html('')
                var txt = '';
                var iconcolor_gluco
                for (var i = 0; i < data.length; i++) {
                    if (data.glucose_value >= 100){
                        if (data.glucose_value >= 125){
                            iconcolorgluco = 'red';
                        } else {
                        iconcolorgluco = 'yellow';
                        }

                    } else  {
                        if (data.glucose_value < 55){
                            icoloncolorgluco = '#red';
                        } else {
                        iconcolorgluco = 'green'
                        }
                    }
                }
                txt = txt + '<tr>';
                txt = txt + '<td>';
                txt = txt + '<span class="fa fa - bar - chart" style="color:' + #ffad33 + '"></span>'
                txt = txt + data[i].glucose_value;
                txt = txt + '</td>';
                txt = txt + '<td>';
                txt = txt + data[i].date;
                txt = txt + '</td>';
                txt = txt + '<td>';
                txt = txt + data[i].time;
                txt = txt + '</td>';
                txt = txt + '<td>';
                txt = txt + data[i].sys_test_types_id;
                txt = txt + '</td>';
                txt = txt + '<td>';
                txt = txt + data[i].insulin_value;
                txt = txt + '</td>';
                txt = txt + '<td>';
                txt = txt + data[i].notes;
                txt = txt + '</td>';
                txt = txt + '<td class="table-text">\
                    <div>\
                    <form id="frm_del_{{$test->id}}"action="/test/' + data.id + '"  method="POST">\
                    <button class="btn btn-danger" data-id="' + data.id + '"><?php echo trans('messages.delete_test'); ?></button>\
                    </form>\
                    </div>\
                    </td>\
                    <td class="table-text">\
                    <div>\
                    <form action="/edittest/' + data.id + '" method="POST">\
                    <button class="btn btn-default"><?php echo trans('messages.edit_test'); ?></button>\
                    </form>\
                    </div>\
                    </td>';
            }
            $('#tests_table_body').append(txt);
            console.log(data)
            })

        }
    })*/

           $('#tests_table .btn-danger').click(function (e) {
    e.preventDefault();
            id = $(this).attr('data-id');
            var message = ' <?php echo trans('messages.test_deletion_confirm_message'); ?>'
            var msg = confirm(message)
            //console.log("OK"+msg);
            if (msg) {
    $.get('test/' + id, function (data) {

    location.reload();
    })
    }
    })

            // $('#glucose_value_spinbox').spinbox();
            //  $('#insulin_value_spinbox').spinbox();
            $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    });


</script>

<!--END KENDO Wrappers-->
@endif
@endsection