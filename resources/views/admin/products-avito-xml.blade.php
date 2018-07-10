<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
@foreach ($products as $product)
	<Ad>
		<Id>{{ $product->id }}</Id>
		<Category>Запчасти и аксессуары</Category>
		<AdType>Товар приобретен на продажу</AdType>
		<TypeId>{{ $product->category->avito }}</TypeId>
		<CompanyName>{{ $shop->name }}</CompanyName>
		<ManagerName>Менеджер</ManagerName>
		<ContactPhone>{{ $shop->phone }}</ContactPhone>
		<Region>Санкт-Петербург</Region>
		<Subway>Старая Деревня</Subway>
		<Title>{{ $product->name }}</Title>
		<Description>
			<![CDATA[
			<p>
				{{ $shop->information }}
				
				<br /><br />
			</p>
			
			<p>	
			<strong>
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
			</p>
			
			<p>
			@if ($product->meta != NULL)
				<p><strong>Для двигателей: </strong>&nbsp; 
				
				@php
					$engines = $product->meta;
					$engines = explode(',', $engines);
					array_splice($engines, 5);
				@endphp
				@foreach ($engines as $engine)
					{{ $engine }},
				@endforeach
				
				<br /><strong>
			@endif
			</p>
			
			<p>
			@if ($product->description != NULL)
				{{ $product->description }}<br />
			@endif
			</p>
			
			<p>
				<em>
				{{ $shop->additional_information }}
				</em>
			</p>]]>
		</Description>
		<Price>{{ $product->price }}</Price>
		<Images>
			<Image url="{{ $product->image }}"/>
		</Images>
	</Ad>
@endforeach