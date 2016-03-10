@extends('layouts.app')
@section('content')
<script>
//  $(function () {
//       
//        $("#insertTestButtonDiv").hide();
//    });
</script>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    I tuoi dati
                </div>
                <div class="panel-body">

                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!-- New Task Form -->
                    <form action="/usersettings/update" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="col col-sm-10 col-sm-offset-1">
                            <div class="panel panel-info">

                                <div class="panel-heading">Informazioni anagrafiche</div>
                                <div class="panel-body">


                                    <!-- Name -->
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="firstname" class="col-sm-3 control-label">Nome</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="firstname" class="form-control" value="{{$user->firstname}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">

                                            <label for="lastname" class="col-sm-3 control-label">Cognome</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="lastname" class="form-control" value="{{$user->lastname}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- E-Mail Address -->
                        <!--div class="form-group">
                            <label for="email" class="col-sm-3 control-label">E-Mail</label>
                            <div class="col-sm-6">
                                <input type="email" name="email"  disabled="true" class="form-control" value="">
                            </div>
                        </div>
                        <!-- Password -->
                        <!--div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password" disabled="true" class="form-control">
                            </div>
                        </div>
                        <!-- Confirm Password -->
                        <!--div class="form-group">
                            <label for="password_confirmation" class="col-sm-3 control-label">Conferma Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password_confirmation" disabled="true" class="form-control">
                            </div>
                        </div-->
                        <div class="row">

                            <div class="col col-sm-offset-1 col-sm-10">


                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        Impostazione valori glicemia
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="ipo" class="col-sm-2 control-label">Valore normale minimo glicemia</label>
                                                <div class="col-sm-2">
                                                    <input type="number" name="ipo" class="form-control" value="55" maxlength="3" size="3">
                                                </div>




                                                <label for="maxnorm" class="col-sm-2 control-label">Valore normale massimo glicemia</label>
                                                <div class="col-sm-2">
                                                    <input type="number" name="maxnorm" class="form-control" value="100"  maxlength="3" size="3">
                                                </div>




                                                <label for="maxhyper" class="col-sm-2 control-label">Valore massimo iperglicemia accettabile</label>
                                                <div class="col-sm-2">
                                                    <input type="number" name="maxhyper" class="form-control" value="150" maxlength="3" size="3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-sm-11"></div>
                            <div class=" col-sm-1">
                                <button type="submit" class="btn btn-default" >
                                    <span class="fa fa-btn fa-sign-in"></span>&nbsp;Salva
                                </button>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

