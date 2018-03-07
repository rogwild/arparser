<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<ADS>
@foreach ($products as $product)
	<Ad>
		<!-- НАЧАЛО В идентификатор (следующая страница) -->
		<Id>{{ $product->id }}</Id>
		<!-- КОНЕЦ В идентификатор -->
		
		<Description>
		
		<!-- НАЧАЛО В название -->
		<h3>{{ $product->name }}</h3>
		<!-- КОНЕЦ В название -->
		
		<!-- НАЧАЛО В описание -->
		<p>
			{{ $product->description }}
		</p>
		<!-- КОНЕЦ В описание -->
		
		<!-- НАЧАЛО В мета-теги -->
		<models>
			@php
				$models = $product->models;
				if ($models != NULL) {
					$models = explode(',', $models);
					$translations = array();
					foreach ($models as $model) {
						$model = trim($model);
						$car = DB::table('cars')->where('alias', $model)->first();
						$translation = $car->title;
						array_push ($translations, $translation);
					}
					array_splice($translations, 5);
				}
				else {
					$translations = array();
				}
			@endphp

			@foreach ($translations as $translation)
				{{ $translation }},
			@endforeach
		</models>
		<engines>
			{{ $product->meta }}
		</engines>
		<!-- КОНЕЦ В мета-теги -->
		
		</Description>
		
		<!-- НАЧАЛО В цену -->
		<Price>{{ $product->price }}</Price>
		<!-- КОНЕЦ В цену -->
		
		<!-- НАЧАЛО В картинку -->
		<Image>
			{{ $product->image }}
		</Image>
		<!-- КОНЕЦ В картинку -->
		
	</Ad>
@endforeach
</ADS>