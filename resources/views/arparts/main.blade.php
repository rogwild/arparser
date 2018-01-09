@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<div class="container">
        <div class="row">
        	<div class="col-md">
        		<div class="image_carousel">
        			<a href="#" id="prev" class="prev"><span class="fr-icon2-left-open"></span></a>
        			<a href="#" id="next" class="next"><span class="fr-icon2-right-open"></span></a>
        			<div class="pics" id="s1">
        				<img src="" alt="">
        			</div>
        		</div>
        		<script>// <![CDATA[
$(window).load(function() {
  $('#carousel-slider-abcp').carousel({
   interval: '2000', // В миллисекундах
   wrap: true //true или false, если false - слайдер остановится когда покажет последний слайд.
  });
 });
// ]]>
</script>
<div id="carousel-slider-abcp" class="fr-carousel fr-slide fr-slide-indicator" data-ride="fr-carousel">
 <!-- Слайды -->
	<div class="fr-carousel-inner">
		<div class="fr-item fr-active">
			<a href="Ссылка на страницу">
				<img src="Ссылка на изображение" alt="" />
			</a>
		</div>
		<div class="fr-item">
			<a href="Ссылка на страницу">
				<img src="Ссылка на изображение" alt="" />
			</a>
		</div>
	</div>
	<!-- Стрелки --> 
	<a class="fr-left fr-carousel-control" href="#carousel-slider-abcp" data-slide="prev">
		<span class="fr-icon2-left-open" aria-hidden="true"></span>
	</a>
	<a class="fr-right fr-carousel-control" href="#carousel-slider-abcp" data-slide="next"> 
		<span class="fr-icon2-right-open" aria-hidden="true"></span> 
	</a>
</div>
        		<div id="demo" class="carousel slide" data-ride="carousel">

					  <!-- Indicators -->
					  <ul class="carousel-indicators">
						<li data-target="#demo" data-slide-to="0" class="active"></li>
						<li data-target="#demo" data-slide-to="1"></li>
						<li data-target="#demo" data-slide-to="2"></li>
					  </ul>

					  <!-- The slideshow -->
					  <div class="carousel-inner">
						<div class="carousel-item">
						  <img class="img-responsive" src="https://pp.userapi.com/c824504/v824504513/7ce62/WPwN3C6XygA.jpg" alt="Акция фильтр в подарок к маслу">
						</div>
					  </div>

					  <!-- Left and right controls -->
					  <a class="carousel-control-prev" href="#demo" data-slide="prev">
						<span class="carousel-control-prev-icon"></span>
					  </a>
					  <a class="carousel-control-next" href="#demo" data-slide="next">
						<span class="carousel-control-next-icon"></span>
					  </a>

				</div>
        	</div>
        </div>
</div>
@endsection