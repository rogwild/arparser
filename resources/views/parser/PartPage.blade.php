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
						<label class="control-label" for="description">Изменить описание с 
							@if ($part->description == 1)
								ГРМ
							@elseif ($part->description == 2)
								Прокладки ДВС
							@elseif ($part->description == 3)
								Стойки
							@endif 
							на:</label>
						<select class="form-control" id="description" name="newDescription">
							<option value="0"></option>
							<option value="1">ГРМ</option>
							<option value="2">Прокладки ДВС</option>
							<option value="3">Стойки</option>
							<option value="">пусто</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="category">Изменить категорию с "{{ $part->category }}" на:</label>
						<input class="form-control" id="category" name="newCategory" type="text" placeholder="{{ $part->category }}">
					</div>
					<div class="form-group">
						<label class="control-label" for="avito_category">Изменить категорию на Авито с "{{ $part->avito_category }}" на:</label>
						<select class="form-control" id="avito_category" name="newAvito_category">
							<option value="11-618">Автосвет</option>
							<option value="11-619">Аккумуляторы</option>
							<option value="11-621">Запчасти для ТО</option>
							<option value="11-623">Подвеска</option>
							<option value="11-624">Рулевое управление</option>
							<option value="11-625">Салон</option>
							<option value="16-521">Система охлаждения</option>
							<option value="11-626">Стекла</option>
							<option value="11-627">Топливная и выхлопная системы</option>
							<option value="11-628">Тормозная система</option>
							<option value="11-629">Трансмиссия и привод</option>
							<option value="11-630">Электрооборудование</option>
							<option value="16-827">Двигатель / Блок цилиндров, головка, картер</option>
							<option value="16-828">Двигатель / Вакуумная система</option>
							<option value="16-829">Двигатель / Генераторы, стартеры</option>
							<option value="16-830">Двигатель / Двигатель в сборе</option>
							<option value="16-831">Двигатель / Катушка зажигания, свечи, электрика</option>
							<option value="16-832">Двигатель / Клапанная крышка</option>
							<option value="16-833">Двигатель / Коленвал, маховик</option>
							<option value="16-834">Двигатель / Коллекторы</option>
							<option value="16-835">Двигатель / Крепление двигателя</option>
							<option value="16-836">Двигатель / Масляный насос, система смазки</option>
							<option value="16-837">Двигатель / Патрубки вентиляции</option>
							<option value="16-838">Двигатель / Поршни, шатуны, кольца</option>
							<option value="16-839">Двигатель / Приводные ремни, натяжители</option>
							<option value="16-840">Двигатель / Прокладки и ремкомплекты</option>
							<option value="16-841">Двигатель / Ремни, цепи, элементы ГРМ</option>
							<option value="16-842">Двигатель / Турбины, компрессоры</option>
							<option value="16-843">Двигатель / Электродвигатели и компоненты</option>
							<option value="16-805">Кузов / Балки, лонжероны</option>
							<option value="16-806">Кузов / Бамперы</option>
							<option value="16-807">Кузов / Брызговики</option>
							<option value="16-808">Кузов / Двери</option>
							<option value="16-809">Кузов / Заглушки</option>
							<option value="16-810">Кузов / Замки</option>
							<option value="16-811">Кузов / Защита</option>
							<option value="16-812">Кузов / Зеркала</option>
							<option value="16-813">Кузов / Кабина</option>
							<option value="16-814">Кузов / Капот</option>
							<option value="16-815">Кузов / Крепления</option>
							<option value="16-816">Кузов / Крылья</option>
							<option value="16-817">Кузов / Крыша</option>
							<option value="16-818">Кузов / Крышка, дверь багажника</option>
							<option value="16-819">Кузов / Кузов по частям</option>
							<option value="16-820">Кузов / Кузов целиком</option>
							<option value="16-821">Кузов / Лючок бензобака</option>
							<option value="16-822">Кузов / Молдинги, накладки</option>
							<option value="16-823">Кузов / Пороги</option>
							<option value="16-824">Кузов / Рама</option>
							<option value="16-825">Кузов / Решетка радиатора</option>
							<option value="16-826">Кузов / Стойка кузова</option>
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
