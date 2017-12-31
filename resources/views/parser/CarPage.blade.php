@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>База автомобилей</h1>
			<div class="row">
			  <div class="col-xs-12">
				<form method='POST' action='{{ $action }}' enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<div class="form-group">
						<label class="control-label" for="title">Введите перевод для {{ $car->title }}:</label>
						<input class="form-control" id="title" name="translate" type="text" placeholder="{{ $car->translate }}">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-md pull-right">ИЗМЕНИТЬ</button>
					</div>
					<a href="/parsers/cars" class="btn btn-default">НАЗАД</a>
				</form>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
