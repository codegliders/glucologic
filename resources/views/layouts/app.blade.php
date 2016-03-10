<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"><!--<![endif]-->
<!--html lang="en"-->
    <head>
        <title><?php echo trans('messages.webapp_title'); ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="GlucoLogic gestione glicemia. Con GlucoLogic gestisci facilmente i tuoi valori glicemici">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--CSS-->
         <!--link href="{{asset('assets/css/normalize.css')}}" rel="stylesheet" type="text/css'"/>
          <link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css'"/-->
          
          
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css'"/>
        <link href="{{asset('assets/lib/kendojs/styles/kendo.bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/lib/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/lib/bootstrap/css/bootstrap.min.css')}}">
        <!--link href="{{asset('assets/lib/fuelux/css/fuelux.min.css')}}" rel="stylesheet" type="text/css"/-->
        <link rel="stylesheet" href="{{ asset('assets/lib/bootstrap/css/bootstrap-theme.min.css')}}">


        <!--   JavaScript -->
         <script src="{{ asset('assets/lib/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
       <!--[if lt IE 7]>
<p class="chromeframe">Stai utilizzando una versione del browser obsoleta
<strong>obsoleta</strong> Aggiorna il browser a una versione più recente. ...
<![endif]-->
        <script src="{{ asset('assets/lib/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/lib/moment.min.js')}}"></script>

        <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>
        <!--script src="{{asset('assets/lib/fuelux/js/fuelux.min.js')}}" type="text/javascript"></script-->

        <!--KENDO-->

        <link href="{{ asset('assets/lib/kendojs/styles/kendo.common.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/lib/kendojs/styles/kendo.rtl.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/lib/kendojs/styles/kendo.dataviz.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/lib/kendojs/styles/kendo.dataviz.default.min.css')}}" rel="stylesheet">

        <!--script src="{{asset('assets/lib/kendojs/js/kendo.all.min.js')}}"></script-->

        <!--script src="{{asset('assets/lib/kendojs/js/kendo.drawing.min.js')}}"></script-->
        <script src="{{asset('assets/lib/kendojs/js/kendo.core.min.js')}}"></script>	
        <!--for datepicker-->
        <script src="{{asset('assets/lib/kendojs/js/kendo.calendar.min.js')}}"></script>  	
        <script src="{{asset('assets/lib/kendojs/js/kendo.popup.min.js')}}"></script>  	
        <script src="{{asset('assets/lib/kendojs/js/kendo.datepicker.min.js')}}"></script>  	
        <script src="{{asset('assets/lib/kendojs/js/kendo.timepicker.min.js')}}"></script>  	
        <script src="{{asset('assets/lib/kendojs/js/kendo.datetimepicker.min.js')}}"></script> 

        <script src="{{asset('assets/lib/kendojs/js/cultures/kendo.culture.it-IT.min.js')}}"></script>
        <script src="{{asset('assets/lib/kendojs/js/messages/kendo.messages.it-IT.min.js')}}"></script>

        <script type="text/javascript">

kendo.culture("it-IT");
// kendo.messages("it-IT");
        </script>
        <!--/KENDO-->

    </head>

    <body>
        <div class="container">
            <div class="page-header">
                <div class="row">
                    <div class="col col-md-9">
                        <h3> <span class="fa fa-bar-chart fa-lg" style="color: #00ace6"></span>
                            <?php echo trans('messages.glucologic'); ?>
                        </h3>

                        <?php echo trans('messages.motto'); ?>
                    </div>
                    <div class="col col-md-3">

                    </div>
                </div>
            </div>
            <!-- Static navbar -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!--a class="navbar-brand" href="/"><span class="fa fa-bar-chart fa-lg" style="color: #00ace6"></span>&nbsp; <?php echo trans('messages.webapp_title'); ?></a--> 
                    </div>
                    <div id="navbar" class="navbar-collapse collapse" role="navigation">
                      
                        <ul class="nav navbar-nav">
                            <?php if (Auth::check() == true) { ?>
                                <li ><a href="/home">Home</a></li>


                                <!--li><a href="#">Contact</a></li-->
                                <li class="dropdown">
                                    <a href="/tests/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo trans('messages.glycemy'); ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/tests/"><?php echo trans('messages.insert_view_values'); ?></a></li>
                                        <li><a href="/generalreporttests">
                                                <?php echo trans('messages.glycemy_all_my_values'); ?>
                                            </a>
                                        </li>
                                        <!--li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">Nav header</li>
                                        <li><a href="#">Separated link</a></li>
                                        <li><a href="#">One more separated link</a></li-->
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="/chart" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <?php echo trans('messages.reports'); ?>
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/getreportbyinterval">
                                                Andamento glicemie per intervallo date
                                            </a>
                                        </li>
                                        <li><a href="/chart">
                                                Andamento glicemie ultime due settimane
                                            </a>
                                        </li>
                                        <li><a href="/piechartsbytesttype">
                                                Valori glicemici per tipi di test
                                            </a>
                                        </li>
                                        <li><a href="/reportall">
                                                Esporta in excel o pdf tutti i valori inseriti
                                            </a>
                                        </li>
                                        <!--li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">Nav header</li>
                                        <li><a href="#">Separated link</a></li>
                                        <li><a href="#">One more separated link</a></li-->
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                        
                           
                       
                        <ul class="nav navbar-nav navbar-right">
                            <li> <div id="insertTestButtonDiv" >
                                <form class="navbar-form navbar-left" action="/tests">
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Inserisci test glicemico</button>
                                </form>
                            </div></li>
                            <?php if (Auth::check() !== false) { ?>
                         
                            <li>
                                    <a >
                                        <?php
                                        if (Auth::check() == true) {
                                            $userstring = "";
                                            $userstring = '&nbsp; <span class="fa fa-user fa-lg"></span> &nbsp;<strong> ' 
                                                    . Auth::user()->firstname . " " 
                                                    . Auth::user()->lastname."</strong>";
                                            echo $userstring;
                                        }
                                        ?></a>
                                </li>
                                   <li>
                                <a href="usersettings"><i class="fa fa-gear fa-lg"></i></a>
                            </li>
                                <li><a href="auth/logout"><i class="fa fa-btn fa-sign-out fa-lg"></i>&nbsp;<?php echo trans('messages.logout'); ?></a></li>
                                <?php } else { ?>
                                <li><a href="auth/register"><?php echo trans('messages.register'); ?></a></li>
                                <li><a href="auth/login"><?php echo trans('messages.login'); ?></a></li>
                            <?php } ?>
                <!--li ><a href="http://www.codegliders.it">Credits <span class="sr-only">(current)</span></a></li-->
                            <!--li class="active"><a href="../navbar-static-top/">Static top</a></li>
                            <li><a href="../navbar-fixed-top/">Fixed top</a></li-->
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </nav>
        </div>

        @yield('content')
    </body>
</html>