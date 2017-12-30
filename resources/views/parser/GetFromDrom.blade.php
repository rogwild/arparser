@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Для DROM.ru</h1>
			<div class="row">
			  <div class="col-xs-12">
		  			<h6>{{ $link }}</h6>
			  		<img src="{{ $image }}" alt="" class="img-responsive">
					<h4>Категория: {{ $category }}</h4>
					<h2 class="display-4">{{ $titleOfAd }}</h2>
					<br>
					<h3>Цена: {{ $price }} рублей</h3>
					<br>
					<h3>Номер в каталоге: {{ $number }}</h3>
					<br>
					<h3>Применимость:</h3>
					<ul>
						@foreach ($models as $model)
							<li>{{ $model }}</li>
						@endforeach
					</ul>
					<br>
					<p>
						  Если Вы не уверены подойдет ли данная деталь на Ваш автомобиль, ЗВОНИТЕ, наши специалисты помогут подобрать именно то, что Вам необходимо! <br><br>

						  Качественная установка купленных запчастей в нашем АВТОСЕРВИСЕ с 15% скидкой! Подробности уточняйте у наших менеджеров по телефонам!<br><br>

						  Уточнить совместимость детали и наличие на складе Вы можете нажав кнопку ЗАДАТЬ ВОПРОС!
					</p>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
