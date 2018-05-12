<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
@foreach ($products as $product)
	<Ad>
		<Id>{{ $product->id }}</Id>
		<Category>Запчасти и аксессуары</Category>
		<TypeId>{{ $product->category->avito }}</TypeId>
		<CompanyName>{{ $shop->name }}</CompanyName>
		<ManagerName>Менеджер</ManagerName>
		<ContactPhone>8 812 407-37-33</ContactPhone>
		<Region>Санкт-Петербург</Region>
		<Subway>Старая Деревня</Subway>
		<Title>{{ $product->name }}</Title>
		<Description>
			<![CDATA[
			<p><strong>
			В <strong>интернет-магазине Arparts</strong> Вы всегда найдете большой ассортимент запасных частей, масел и расходных материалов для автомобилей иностранного производства. Более подробная <strong>ИНФОРМАЦИЯ ОБ ОПЛАТЕ И ДОСТАВКЕ</strong> указана на нашем сайте.
			</strong><br /><br /><strong>
			В продаже:
			</strong><br /><em>
			<strong>{{ $product->name }}</strong> в Санкт-Петербурге. </em>&nbsp;Новый!</p>
			<p>
			<br /><strong>
			Применимость:
			</strong></p>
			<ul>
					@php
						$models = $product->models;
						$models = explode(',', $models);
						$translations = array();
						foreach ($models as $model) {
							$model = trim($model);
							$car = DB::table('cars')->where('alias', $model)->first();
							if ($car != NULL) {
								$translation = $car->title.' ('.$car->translate.')';
								array_push ($translations, $translation);
							}
							else {
								$translations = array("Универсальная");
							}
							
						}
						array_splice($translations, 5);
					@endphp
				@foreach ($translations as $translation)
					<li>{{ $translation }}</li>
				@endforeach
			</ul>
			@if ($product->meta != NULL)
				<p><strong>Для двигателей: </strong>&nbsp; {{ $product->meta }} <br /><strong>
			@endif
			@if ($product->description != NULL)
				Номер детали: {{ $product->description }}<br />
			@endif
			<em>
			<strong>Более подробную информацию об ОПЛАТЕ и ДОСТАВКЕ в города России и СНГ Вы можете посмотреть на нашем сайте или в соответствующем разделе на сайте Авито.</strong></p>]]>
		</Description>
		<Price>{{ $product->price }}</Price>
		<Images>
			<Image url="{{ $product->image }}"/>
		</Images>
	</Ad>
@endforeach