@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
	  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		  <h1>База деталей</h1>
		  	<div class="table-responsive table-responsive-sm text-center">
		  		<table class="table table-striped table-hover">
				  <thead>
					<tr>
				  	  <th></th>
					  <th>Картинка</th>
					  <th>Название</th>
					  <th>Модели</th>
					  <th>Описание</th>
					  <th>Категория на Авито</th>
					  <th>
					  	Цена (увеличенная) <br>
					  	Цена (скопированная)
					  </th>
					  <th>Двигатели</th>
					  <th>Номер</th>
					  <th>Ссылка</th>
					  <th></th>
					</tr>
				  </thead>
				  <tbody>
				  @foreach ($parts as $part)
					<tr>
					  <th scope="row">
					  	<a href="parts/{{ $part->id }}/edit" class="btn btn-default btn-xs">
					  	{{ $part->id }}
					  	</a>
					  </th>
					  <td><img src="{{ $part->image }}" alt="" class="img-thumbnail"></td>
					  <td>
						  <a href="parts/{{ $part->id }}">
							  <small>
								{{ $part->titleOfAd }}
							  </small>
						  </a>
					  </td>
					  <td>
					  <p>
					  	<small>
					  		{{ $part->models }}
					  	</small>
					  </p>
					  </td>
					  <td>{{ $part->description }}</td>
					  <td>{{ $part->avito_category }}</td>
					  <td>
					  	{{ $part->price }} <br>
					  	{{ $part->price_main }}
					  </td>
					  <td>{{ $part->parsed_engine }}</td>
					  <td>{{ $part->number }}</td>
					  <td><a href="{{ $part->link }}">DROM.ru</a></td>
					  <td>
					  	<a href="parts/{{ $part->id }}/delete" class="btn btn-danger btn-xs">УДАЛИТЬ</a>
					  </td>
					</tr>
				  @endforeach
				  </tbody>
				</table>
		  	</div>
		  </div>
    </div>
</div>
@endsection
