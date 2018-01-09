@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center">
	  <div class="col-md-auto">
		  <h1>База Автомобилей</h1>
		  	<div class="table-responsive table-responsive-sm text-center">
		  		<table class="table table-striped table-hover">
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
@endsection
