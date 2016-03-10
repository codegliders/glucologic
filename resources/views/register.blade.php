@extends('layouts.app')
@section('content')
<script>
  $(function () {
       
        $("#insertTestButtonDiv").hide();
    });
</script>
<div class="container">
<div class="col-sm-offset-2 col-sm-8">
<div class="panel panel-primary">
<div class="panel-heading">
Benvenuto!
</div>
<div class="panel-body">
    Qui puoi gestire i tuoi valori glicemici.<br>
<a href="/auth/register">Registrati</a> o <a href="/auth/login">Accedi</a>.
</div>
</div>
</div>
</div>
@endsection
