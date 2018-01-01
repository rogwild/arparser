@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Изменить данные детали</h1>
			<div class="row">
			  <div class="col-xs-12">
				<form method='POST' action='{{ $action }}' enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<div class="form-group">
						<label class="control-label" for="title">Изменить название с "{{ $part->titleOfAd }}" на:</label>
						<input class="form-control" id="title" name="newTitle" type="text" placeholder="{{ $part->titleOfAd }}">
					</div>
					<div class="row">
						<div class="col-sm-6">
							<img src="{{ $part->image }}" alt="" class="img-thumbnail">
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label" for="image">Изменить ссылку на картинку {{ $part->image }}:</label>
								<input class="form-control" id="image" name="newImage" type="text" placeholder="{{ $part->image }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="models">Список моделей "{{ $part->models }}" на:</label>
						<input class="form-control" id="models" name="newModels" type="text" placeholder="{{ $part->models }}">
					</div>
					<div class="form-group">
						<label class="control-label" for="category">Изменить категорию с "{{ $part->category }}" на:</label>
						<input class="form-control" id="category" name="newCategory" type="text" placeholder="{{ $part->category }}">
					</div>
					<div class="form-group">
						<label class="control-label" for="avito_category">Изменить категорию на Авито с "{{ $part->avito_category }}" на:</label>
						<select class="form-control" id="avito_category" name="newAvito_category">
							<option value="Автосвет">Автосвет</option>
							<option value="Аккумуляторы">Аккумуляторы</option>
							<option value="Двигатель">Двигатель</option>
							<option value="Запчасти для ТО">Запчасти для ТО</option>
							<option value="Кузов">Кузов</option>
							<option value="Подвеска">Подвеска</option>
							<option value="Рулевое управление">Рулевое управление</option>
							<option value="Салон">Салон</option>
							<option value="Система охлаждения">Система охлаждения</option>
							<option value="Стекла">Стекла</option>
							<option value="Топливная и выхлопная системы">Топливная и выхлопная системы</option>
							<option value="Тормозная система">Тормозная система</option>
							<option value="Трансмиссия и привод">Трансмиссия и привод</option>
							<option value="Электрооборудование">Электрооборудование</option>
							<option value="">пусто</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="price">Цена "{{ $part->price }}" на:</label>
						<input class="form-control" id="price" name="newPrice" type="text" placeholder="{{ $part->price }}">
					</div>
					<div class="form-group">
						<label class="control-label" for="price_main">Скопированная цена "{{ $part->price_main }}" на:</label>
						<input class="form-control" id="price_main" name="newPrice_main" type="text" placeholder="{{ $part->price_main }}">
					</div>
					<div class="form-group">
						<label class="control-label" for="link">Ссылка на товар "{{ $part->link }}" на:</label>
						<input class="form-control" id="link" name="newLink" type="text" placeholder="{{ $part->link }}">
					</div>
					<div class="form-group">
						<label class="control-label" for="parsed_engine">Двигатели "{{ $part->parsed_engine }}" на:</label>
						<input class="form-control" id="parsed_engine" name="newParsed_engine" type="text" placeholder="{{ $part->parsed_engine }}">
					</div>
					<div class="form-group">
						<label class="control-label" for="number">Номер "{{ $part->number }}" на:</label>
						<input class="form-control" id="number" name="newNumber" type="text" placeholder="{{ $part->number }}">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-md pull-right">ИЗМЕНИТЬ</button>
					</div>
					<a href="/parsers/parts" class="btn btn-default">НАЗАД</a>
				</form>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
