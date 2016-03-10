@extends('layouts.app')
@section('content')
<script>
  $(function () {
       
        $("#insertTestButtonDiv").hide();
    });
</script>
<div class="container">
    <div class="panel"><div class="panel panel-body">
            <div class="col-sm-offset-2 col-sm-8">
                <div><h4> Con GlucoLogic puoi gestire facilmente i tuoi valori glicemici</h4>
                    <p><a href="/auth/register">Registrati</a> per iniziare a utilizzarlo, oppure <a href="/auth/login">accedi</a> se possiedi già un account</
                <br/></div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <?php echo trans('messages.webapp_title'); ?>
                    </div>
                    <div class="panel-body" >


                        <img class="img-rounded img-responsive" src="assets/img/dia.jpg"  alt=""/>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
