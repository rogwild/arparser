<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Arparser') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
</head>
    <body>
       <div class="container text-center">
       	<div class="row">
       		<div class="col-xl">
       			<h1 class="display-1" style="margin-top: 250px;">
       				Arparser
       			</h1>
       			<a href="{{ route('parser.drom') }}" class="text-muted">Парсеры</a>
       			<a href="{{ route('cars.table') }}" class="text-muted">Автомобили</a>
       			<a href="{{ route('parts.table') }}" class="text-muted">Детали</a>
       		</div>
       	</div>
       </div>
    </body>
</html>