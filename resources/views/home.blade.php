@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Панель управления</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4><a href="/parsers">Парсеры</a></h4>
                    <h4><a href="/parsers/cars">Автомобили</a></h4>
                    <h4><a href="/parsers/parts">Детали <span class="badge badge-success">Новинка</span></a></h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
