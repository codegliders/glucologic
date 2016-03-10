@extends('layouts.app')

@section('content')

<!-- Bootstrap Boilerplate... -->
<div class="container">

<div class="panel panel-info">
    <div class="panel-heading "><?php echo trans('messages.insert_glucose_test'); ?></div>
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="/testupdate/{{$test[0]->id}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Glucotest inputs -->
            <div class="form-group">
                <label for="date" class="col-sm-3 control-label"><?php echo trans('messages.date'); ?></label>

                <div class="col-sm-6">
                    <input type="text" name="date" id="date" class="form-control" value='{{ $test[0]->date}}'>
                </div>
            </div>

            <div class="form-group">
                <label for="time" class="col-sm-3 control-label"><?php echo trans('messages.time'); ?></label>

                <!--div class="col-sm-6">
                    <input type="text" name="time" id="time" class="form-control"  value="{{ $test[0]->time}}">
                </div-->
                  <div class="col-sm-2">
                        <!--input type="text" name="time" id="time" class="form-control"-->
                        <!-- kendo timepicker does not work properly in android without kendo.all.min.js-
                        - using a select for the moment-->
                        <select class="form-control" name="time" id="time">
                            <?php
                           // error_log('$time'. $time ."('0$ i.00')".('0'.$i.':00'));
                            for ($i = 0; $i < 24; $i++) {
                                  error_log('$time'. $time ."('0$ i.00')".('0'.$i.':00'));
                                if ($i < 10) {
                                    if($time == ('0'.$i.':00:00')){
                                    echo '<option value="0' . $i . ':00" selected>0' . $i . ':00</option>';
                                    } else  {
                                    echo '<option value="0' . $i . ':00">0' . $i . ':00</option>';
                                    }
                                    
                                    
                                     if($test[0]->time == ('0'.$i.':30:00')){
                                         
                                          echo '<option value="0' . $i . ':30" selected>0' . $i . ':30</option>';
                                     }
                                      else  {
                                      echo '<option value="0' . $i . ':30">0' . $i . ':30</option>';
                                      
                                      }
                                } else {
                                     if($test[0]->time == ($i.':00:00')){
                                     echo '<option value="' . $i . ':00" selected>' . $i . ':00"</option>';
                                     
                                     } else{
                                         echo '<option value="' . $i . ':00">' . $i . ':00</option>';
                                     }
                                     if($test[0]->time == ($i.':30:00')){
                                    echo '<option value="' . $i . ':30" selected>' . $i . ':30</option>';
                                     } else {
                                          echo '<option value="' . $i . ':30">' . $i . ':30</option>';
                                     }
                                }
                            }
                            ?>

                        </select>
                    </div>
            </div>

            <div class="form-group">
                <label for="glucose_value" class="col-sm-3 control-label" ><?php echo trans('messages.glucose_value'); ?></label>

                <div class="col-sm-2">
                    <input type="text" name="glucose_value" id="glucose_value"   value="{{ $test[0]->glucose_value}}" class="form-control">
                    <!--div class="fuelux">
                        <div class="spinbox"  id="glucose_value_spinbox"  id="glucose_value_1"  name="glucose_value_1" >
                            <input type="text" id="glucose_value" value="{{ $test[0]->glucose_value}}" name="glucose_value" class="form-control input-mini spinbox-input">
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
                       
                        
                        @foreach($test_types as $test_type)
                        
                        @if($selectedcode==$test_type->code)
                        <option value="{{$test_type->code}}" selected>{{$test_type->description_it}}</option>
                        @else
                            <option value="{{$test_type->code}}">{{$test_type->description_it}}</option>
                        @endif
                        
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="form-group">
                <label for="insulin_value" class="col-sm-3 control-label"><?php echo trans('messages.insulin_value'); ?></label>

                <div class="col-sm-2">
<input type="text" value="{{ $test[0]->insulin_value}}" id="insulin_value"  name="insulin_value" class="form-control input-mini spinbox-input">
                    <!--div class="fuelux">
                        <div class="spinbox"  id="insulin_value_spinbox"  id="insulin_value_1"  name="insulin__value_1" >
                            <input type="text" value="{{ $test[0]->insulin_value}}" id="insulin_value"  name="insulin_value" class="form-control input-mini spinbox-input">
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
                    <input type="textarea" name="notes" id="notes" value="{{ $test[0]->notes}}" class="form-control">
                </div>
            </div>
            <!-- Add Task Button -->
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
   </tbody>
        </table>
    </div>

</div>
</div>

<!--KENDO Wrappers and other wrappers-->
<script>
    

    $(document).ready(function () {
        // create DatePicker from input HTML element
        $("#date").kendoDatePicker({
            format: "yyyy-MM-dd"}
        );
     //   $('#time').kendoTimePicker();

//se si voglioni impostare i valori
//$('#glucose_value').spinbox({
//  'value': 80,
//  'min' : 1
//});
//
//        $('#glucose_value_spinbox').spinbox();
//        $('#insulin_value_spinbox').spinbox();

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    });


</script>

<!--END KENDO Wrappers-->

@endsection