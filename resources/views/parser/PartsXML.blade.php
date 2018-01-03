<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
@foreach ($parts as $part)
	<Ad>
		<Id>{{ $part->id }}</Id>
		<Category>Запчасти и аксессуары</Category>
		<TypeId>11-623</TypeId>
		<CompanyName>JDMstore</CompanyName>
		<ManagerName>Менеджер</ManagerName>
		<ContactPhone>8-812-988-22-64</ContactPhone>
		<Region>Санкт-Петербург</Region>
		<Subway>Старая Деревня</Subway>
		<Title>{{ $part->titleOfAd }}</Title>
		<Description>
			JDMstore - это более 2 500 000 запчастей в наличии и под заказ для японских автомобилей: Toyota, Nissan, Mitsubishi, Honda! Звоните, наши опытные менеджеры подберут необходимую Вам деталь в кратчайшие сроки!

			В продаже:
			{{ $part->titleOfAd }} в Санкт-Петербурге. Новый!
			Применимость:
			
			@foreach ($translations as $translation)
			{{ $translation }}
			@endforeach
			
			Для двигателей: {{ $part->parsed_engine }}
			Номер детали: {{ $part->number }}
			Так же есть детали других производителей новые и контрактные!
			Качественная установка купленных автозапчастей в нашем автосервисе с 20% скидкой!
			Информацию об ОПЛАТЕ И ДОСТАВКЕ Вы можете посмотреть на нашем сайте или в соответствующих разделах на авито!
		</Description>
		<Price>{{ $part->price }}</Price>
		<Images>
			<Image url="{{ $part->image }}"/>
		</Images>
	</Ad>
@endforeach
