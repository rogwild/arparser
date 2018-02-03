<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
@foreach ($parts as $part)
	<Ad>
		<Id>{{ $part->id+241 }}</Id>
		<Category>Запчасти и аксессуары</Category>
		<TypeId>{{ $part->avito_category }}</TypeId>
		<CompanyName>JDMstore</CompanyName>
		<ManagerName>Менеджер</ManagerName>
		<ContactPhone>8-812-988-22-64</ContactPhone>
		<Region>Санкт-Петербург</Region>
		<Subway>Старая Деревня</Subway>
		<Title>{{ $part->titleOfAd }}</Title>
		<Description>
			<![CDATA[
			<p><strong>
			JDMstore - это более 2 500 000 запчастей в наличии и под заказ для японских автомобилей: Toyota, Nissan, Mitsubishi, Honda! Звоните, наши опытные менеджеры подберут необходимую Вам деталь в кратчайшие сроки!
			</strong><br /><br /><strong>
			В продаже:
			</strong><br /><em>
			{{ $part->titleOfAd }} в Санкт-Петербурге. </em>&nbsp;Новый!</p>
			<p><strong> </strong>
			{{ $part->descriprion }}
				@if ($part->description == 1)
					Комплект для замены цепи ГРМ.<br />
					В комплект входит: цепь грм, гидронатяжитель, успокоитель, башмак, шестерня, цепь балансира.<br />
				@elseif ($part->description == 2)
					Полный комплект сальников и прокладок для ремонта ДВС: <br />
					Прокладка ГБЦ, сальник коленвала, кольца и др.<br />
				@elseif ($part->description == 3)
					Стойка амортизатора, амортизатор<br />
				@endif
			<br /><strong>
			Применимость:
			</strong></p>
			<ul>
					@php
						$models = $part->models;
						$models = explode(',', $models);
						$translations = array();
						foreach ($models as $model) {
							$model = trim($model);
							$car = DB::table('cars')->where('alias', $model)->first();
							$translation = $car->title.' ('.$car->translate.')';
							array_push ($translations, $translation);
						}
						array_splice($translations, 5);
					@endphp
				@foreach ($translations as $translation)
					<li>{{ $translation }}</li>
				@endforeach
			</ul>
			<p><strong>Для двигателей: </strong>&nbsp; {{ $part->parsed_engine }} <br /><strong>
			Номер детали: {{ $part->number }}
			<em>
			Так же есть детали других производителей новые и контрактные!</em><br />
			Качественная установка купленных автозапчастей в нашем автосервисе с 20% скидкой!<br />
			Информацию об ОПЛАТЕ И ДОСТАВКЕ Вы можете посмотреть на нашем сайте или в соответствующих разделах на авито!</strong></p>]]>
		</Description>
		<Price>{{ $part->price }}</Price>
		<Images>
			<Image url="{{ $part->image }}"/>
		</Images>
	</Ad>
@endforeach
