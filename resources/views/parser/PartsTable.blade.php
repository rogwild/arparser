@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
	  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		  <h1>База деталей</h1>
				<table class="table table-hover table-responsive">
				  <thead>
					<tr>
					  <th>Картинка</th>
					  <th>Название</th>
					  <th>Модели</th>
					  <th>Категория</th>
					  <th>Категория на Авито</th>
					  <th>Цена (увеличенная)</th>
					  <th>Цена (скопированная)</th>
					  <th>Двигатели</th>
					  <th>Номер</th>
					  <th>Ссылка</th>
					  <th></th>
					</tr>
				  </thead>
				  <tbody>
				  @foreach ($parts as $part)
					<tr>
					  <td><img src="{{ $part->image }}" alt="" class="img-responsive"></td>
					  <td>{{ $part->titleOfAd }}</td>
					  <td>{{ $part->models }}</td>
					  <td>{{ $part->category }}</td>
					  <td>{{ $part->avito_category }}</td>
					  <td>{{ $part->price }}</td>
					  <td>{{ $part->price_main }}</td>
					  <td>{{ $part->parsed_engine }}</td>
					  <td>{{ $part->number }}</td>
					  <td><a href="{{ $part->link }}">DROM.ru</a></td>
					  <td>
					  	<a href="parts/{{ $part->id }}" class="btn btn-default btn-xs">ИЗМЕНИТЬ</a>
					  	<a href="parts/{{ $part->id }}/delete" class="btn btn-danger btn-xs">УДАЛИТЬ</a>
					  </td>
					</tr>
				  @endforeach
				  </tbody>
				</table>
		  </div>
    </div>
</div>
@endsection
