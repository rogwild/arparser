@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>
            	Для DROM.ru 
            	<a href="{{ URL::action('ParserController@PartEdit', $part->id) }}" class="btn btn-default btn-xs">Изменить</a>
            </h1>
			<div class="row">
			  <div class="col-xs-12">
		  			<h6>{{ $link }}</h6>
			  		<img src="{{ $image }}" alt="" class="img-responsive">
					<h4>Категория: {{ $category }}</h4>
					<h2 class="display-4">{{ $title_promo }}</h2>
					<br>
					<p>Обычная цена: {{ $price_main }} рублей</p>
					<h3>Наша цена: {{ $price }} рублей</h3>
					<br>
					<h3>Номер в каталоге: {{ $number }}</h3>
					<br>
					<h3>Применимость:</h3>
					<ul>
					  	@foreach ($translations as $translation)
					  		<li>{{ $translation }}</li>
						@endforeach
					</ul>
					<br>
					{{ $description }}
					<p>
						  Если Вы не уверены подойдет ли данная деталь на Ваш автомобиль, ЗВОНИТЕ, наши специалисты помогут подобрать именно то, что Вам необходимо! <br><br>

						  Качественная установка купленных запчастей в нашем АВТОСЕРВИСЕ с 15% скидкой! Подробности уточняйте у наших менеджеров по телефонам!<br><br>

						  Уточнить совместимость детали и наличие на складе Вы можете нажав кнопку ЗАДАТЬ ВОПРОС!
					</p>
			  </div>
			</div>
       
       		<hr>
			<h1>Для AVITO.ru</h1>
			<div class="row">
			  <div class="col-xs-12">
			  		<img src="{{ $image }}" alt="" class="img-responsive">
					<h4>Категория: {{ $category }}</h4>
					<h2 class="display-4">{{ $titleOfAd }}</h2>
					<br>
					<h3>Цена: {{ $price }} рублей</h3>
					<br>
					<p>
						  <strong>JDMstore - это более 2 500 000 запчастей в наличии и под заказ для японских автомобилей: Toyota, Nissan, Mitsubishi, Honda! Звоните, наши опытные менеджеры подберут необходимую Вам деталь в кратчайшие сроки!</strong><br><br>

							<strong>В продаже:</strong><br>

							<i> 
								{{ $titleOfAd }}

								в Санкт-Петербурге.</i> Новый!<br>



							 <strong>Применимость:</strong><br>
								<ul>
									@foreach ($translations as $translation)
										<li>{{ $translation }}</li>
									@endforeach
								</ul>


							<strong>Для двигателей:</strong>

							{{ $parsed_engine }}<br>



							<strong><i>Так же есть детали других производителей новые и контрактные!</i><br>

							Качественная установка купленных автозапчастей в нашем автосервисе с 20% скидкой!<br>

							Информацию об ОПЛАТЕ И ДОСТАВКЕ Вы можете посмотреть на нашем сайте или в соответствующих разделах на авито!</strong>
					</p>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
