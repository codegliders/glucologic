@extends('layouts.app')


@section('content')


<div class="container">

    <div class="panel panel-info">
        <div class="panel-heading">
            <?php echo trans('messages.glycemy_all_my_values'); ?>
        </div>

        <div class="panel-body">
            <!--p>Pagina {{$glucotests->currentPage()}} di {{$glucotests->lastPage()}} - Totale test: {{$glucotests->total()}} </p-->

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
            <!--div class="pagination"> 
 
                 {!! $glucotests->render() !!}
             </div-->

            <div class="table-responsive">

                <table class="table table-striped test-table" id="tests_table">

                    <!-- Table Headings -->
                    <thead>
                    <th><?php echo trans('messages.glucose_value'); ?></th>
                    <th><?php echo trans('messages.date'); ?></th>
                    <th><?php echo trans('messages.time'); ?></th>
                    <th><?php echo trans('messages.test_type'); ?></th>
                    <th><?php echo trans('messages.insulin_value'); ?></th>
                    <th><?php echo trans('messages.notes'); ?></th>

                    </thead>


                    <!-- Table Body -->
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
                <!--div class="pagination"> 

                    {!! $glucotests->render() !!}
                </div-->
                <!--p> Pagina {{$glucotests->currentPage()}} di {{$glucotests->lastPage()}} - Totale test: {{$glucotests->total()}} </p-->
            </div>

        </div>

    </div>

</div>
<script>  
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
   /* $('#tests_table .btn-danger').css('border', '1px solid red').click(function (e) {
        e.preventDefault();
        id = $(this).attr('data-id');
        var dlbuttonmgs;
        var txt="";
        var msg = confirm('Are you sure you want to delete this?')
        if (msg) {
             $.get('test/' + id, function (data) {
                data = JSON.parse(data);
                $('#tests_table_body').html('');
                var txt = '';
                var iconcolorgluco=null;
                for (var i = 0; i < data.length; i++) {
                    if (data.glucose_value >= 100){
                        if (data.glucose_value >= 125){
                            iconcolorgluco = 'red';
                        } else {
                        iconcolorgluco = 'yellow';
                        }

                    } else  {
                        if (data.glucose_value < 55){
                            icoloncolorgluco = 'red';
                        } else {
                        iconcolorgluco = 'green'
                        }
                    }
                }
                txt = txt + '<tr>';
                txt = txt + '<td>';
                txt = txt + '<span class="fa fa- bar-chart" style="color:' + iconcolorgluco + '"></span>'
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
                })
                
            $('#tests_table_body').append(txt);
            console.log(data)
            
            }

        });
        */
           
        /*    $('#tests_table .btn-danger').css('border', '1px solid red').click(function (e) {
        e.preventDefault();
        id = $(this).attr('data-id');
        var dlbuttonmgs;
        var txt="";
        var msg = confirm('Are you sure you want to delete this?')
        if (msg) {
             $.get('test/' + id, function (data) {
                       console.log(data)
                 if(!data) {
                     alert("data is undefined")
                 }  
           
                data = JSON.parse(data);
                
                
                 $('#tests_table_body').html('');
                 $.each(data, function(i,item){
                   //  console.log(item.glucose_value)
           
               // var txt = '';
                var iconcolorgluco=null;
                //for (var i = 0; i < data.length; i++) {
                    if (data.glucose_value >= 100){
                        if (data.glucose_value >= 125){
                            iconcolorgluco = 'red';
                        } else {
                        iconcolorgluco = 'yellow';
                        }

                    } else  {
                        if (data.glucose_value < 55){
                            icoloncolorgluco = 'red';
                        } else {
                        iconcolorgluco = 'green'
                        }
                    }
                //}
                txt = txt + '<tr>';
                txt = txt + '<td>';
                txt = txt + '<span class="fa fa- bar-chart" style="color:' + iconcolorgluco + '"></span>'
                txt = txt + item.glucose_value;
                txt = txt + '</td>';
                txt = txt + '<td>';
                txt = txt + item.date;
                txt = txt + '</td>';
                txt = txt + '<td>';
               txt = txt + item.time;
                txt = txt + '</td>';
                txt = txt + '<td>';
                txt = txt + item.sys_test_types_id;
                txt = txt + '</td>';
                txt = txt + '<td>';
               txt = txt + item.insulin_value;
                txt = txt + '</td>';
                txt = txt + '<td>';
                txt = txt + item.notes;
                txt = txt + '</td>';
                txt = txt + '<td class="table-text">\
                    <div>\
                    <form id="frm_del_{{$test->id}}" action="/test/ + data.id + "  method="POST">\
                    <button class="btn btn-danger" data-id=" + data.id + "><?php echo trans('messages.delete_test'); ?></button>\
                    </form>\
                    </div>\
                    </td>\
                    <td class="table-text">\
                    <div>\
                    <form action="/edittest/ + data.id + " method="POST">\
                    <button class="btn btn-default"><?php echo trans('messages.edit_test'); ?></button>\
                    </form>\
                    </div>\
                    </td>';
                    })
                
                
                console.log(txt);
                
                 $('#tests_table_body').html(txt);*/
                
                
               /* $('#tests_table_body').html('');
                var txt = '';
                var iconcolorgluco=null;
                for (var i = 0; i < data.length; i++) {
                    if (data.glucose_value >= 100){
                        if (data.glucose_value >= 125){
                            iconcolorgluco = 'red';
                        } else {
                        iconcolorgluco = 'yellow';
                        }

                    } else  {
                        if (data.glucose_value < 55){
                            icoloncolorgluco = 'red';
                        } else {
                        iconcolorgluco = 'green'
                        }
                    }
                }
                txt = txt + '<tr>';
                txt = txt + '<td>';
                txt = txt + '<span class="fa fa- bar-chart" style="color:' + iconcolorgluco + '"></span>'
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
            })*/
    
               /* })
                
           
      
            
            }

        });*/


</script>
@endsection

