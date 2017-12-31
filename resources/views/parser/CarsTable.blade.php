@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>База автомобилей</h1>
			<div class="row">
			  <div class="col-xs-12">
		  			<table class="table">
					  <thead>
						<tr>
						  <th>Название</th>
						  <th>Транскрипция</th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>
					  @foreach ($cars as $car)
						<tr>
						  <td>{{ $car->title }}</td>
						  <td>{{ $car->translate }}</td>
						  <td><a href="cars/{{ $car->id }}" class="btn btn-default btn-xs">ИЗМЕНИТЬ</a></td>
						</tr>
					  @endforeach
					  </tbody>
					</table>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
