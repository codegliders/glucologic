@extends('layouts.app')
@section('content')
<!--!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Oops! This page was not found.</div>
            </div>
        </div>
    </body>
</html-->
<div class="container ">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <div class="alert alert-warning">
                <h3>Errore 404</h3>
                <h1>Oops! pagina non trovata!</h1>
                <br>
                <form action="/home" method="GET">
                    <button class="btn btn-warning" type="submit">
                       Torna alla home
                    </button>
                </form>
            </div> 

        </div>
    </div> 
</div>

@endsection