@extends('layouts.app_shop')
@section('title', $part->titleOfAd)
@section('content')
        
        <!-- ============================================
        =================== Breadcrumbs =================
        ============================================= -->
        <section id="breadcrumbs" class="breadcrumbs">

            <div class="container clearfix">
                <h1>{{ $part->titleOfAd }}</h1>
                <span>{{ $part->category }}</span>
                <ol class="breadcrumb">
                    <li><a href="{{ route('shop.main.page') }}">Главная</a></li>
                    <li><a href="{{ route('shop.all.parts.page') }}">Все товары</a></li>
                </ol>
            </div>

        </section><!-- #breadcrumbs end -->

        <!-- ============================================
        =================== Content =====================
        ============================================= -->

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                    <div class="row">
                        <!-- PRODUCT DETAIL -->
                        <div class="col-md-12 col-sm-12">

                            <!-- row -->
                            <div class="row">
                                <!-- col -->
                                <div class="col-md-12">

                                    <article class="product-view">

                                        <!-- row -->
                                        <div class="row">

                                            <!-- product gallery -->
                                            <div class="col-md-5">
                                                <div class="product-image">
                                                    <img id="zoom" src="{{ $part->image }}" data-zoom-image="{{ $part->image }}" alt="" class="img-responsive">
                                                    <div class="product-gallery" data-lightbox="gallery">

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <a href="{{ $part->image }}" data-lightbox="gallery-item">
                                                                    <img src="{{ $part->image }}"  alt="" class="img-responsive">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /product gallery -->

                                            <!-- product details -->
                                            <div class="col-md-7 product-details">

                                                <h4>{{ $part->titleOfAd }}</h4>

                                                <div class="price-block">
                                                    <p class="price">{{ $part->price }} рублей</p>
                                                    <p class="availability">Категория: <span class="in-stock">{{ $part->category }}</span></p>
                                                </div>

                                                <div class="product-desc">
                                                    <p>{{ $part->main_description }}</p>
                                                    <p>Двигатели: {{ $part->parsed_engine }}</p>

                                                    <ul class="list-unstyled">
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
															<li><i class="fa fa-caret-right"></i> {{ $translation }}</li>
														@endforeach
                                                    </ul>
                                                </div>

                                                <div class="add-to-cart">
                                                    <button class="myBtn myBtn-border myBtn-rounded myBtn-sm myBtn-midlight pull-right" data-toggle="modal" data-target="#myModal">Купить</button>
                                                    <input type="text" value="1" class="myInput quantity touchspin">
                                                </div>

                                                <div class="well review">
                                                    <ul class="list-unstyled">
                                                        <li><span>Номер:</span> {{ $part->number }}</li>
                                                        <li><span>Категория:</span> {{ $part->category }}</li>
                                                        <li><span>Двигатели:</span> {{ $part->parsed_engine }}</li>
                                                    </ul>
                                                </div>

                                            </div>
                                            <!-- /product details -->

                                        </div>
                                        <!-- /row -->

                                        <!-- row -->
                                        <div class="row">
                                            <!-- tab -->
                                            <div class="col-md-12">

                                                <div role="tabpanel" class="info-section">

                                                    <!-- Nav tabs -->
                                                    <ul class="nav nav-tabs myTabs" role="tablist">
                                                        <li role="presentation" class="active"><a href="#desc" aria-controls="desc" role="tab" data-toggle="tab">Информация</a></li>
                                                    </ul>

                                                    <!-- Tab panes -->
                                                    <div class="tab-content">

                                                        <div role="tabpanel" class="tab-pane fade in active" id="desc">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="2">Описание детали</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>Модельный ряд:</td>
                                                                    <td>
                                                                    	@foreach ($translations as $translation)
																			<li>{{ $translation }}</li>
																		@endforeach
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Двигатели:</td>
                                                                    <td>{{ $part->parsed_engine }}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- /tab -->
                                        </div>
                                        <!-- /row -->
                                        
                                    </article>

                                </div>
                                <!-- /col -->
                            </div>
                            <!-- /row -->

                        </div>
                        <!-- END PRODUCT DETAIL -->

                    </div>
                    <!-- /row -->


                    <!-- row -->
                    <div class="row mt-40">

                        <!-- RELATED PRODUCTS -->
                        <div class="col-md-12">
                            <h6 class="text-bold text-uppercase mb-10">Новое поступление</h6>

                            <div class="product-carousel owl-carousel" id="related-products">
                               @foreach ($new_parts as $new_part)
									<div class="carousel-item">
										<article class="product-card">
											<div class="product-image two-sided">
												<img src="{{ $new_part->image }}" alt="">
												<img src="{{ $new_part->image }}" alt="">
												<div class="image-overlay" data-lightbox="gallery">
													<a href="{{ $new_part->image }}" data-lightbox="gallery-item"><i class="fa fa-search-plus"></i></a>
													<a href="{{ $new_part->image }}" class="hidden" data-lightbox="gallery-item"></a>
													<a href="{{ $new_part->image }}"><i class="fa fa-ellipsis-h"></i></a>
												</div>
											</div>
											<div class="product-detail">
												<h4><a href="{{ route('shop.part.page',[$new_part->id]) }}">{{ $new_part->titleOfAd }}</a></h4>
												<span class="price">{{ $new_part->price }}</span>
												<button class="add-to-cart" data-toggle="modal" data-target="#myModal"><i class="fa fa-angle-right"></i> Купить</button>
											</div>
										</article>
									</div>
                                @endforeach
                            </div>

                        </div>
                        <!-- /END RELATED PRODUCTS -->

                        <script type="text/javascript">

                            $(document).ready(function() {

                                $('#related-products').owlCarousel({
                                    loop: true,
                                    nav: true,
                                    autoplay:true,
                                    autoplayTimeout:8000,
                                    autoplayHoverPause:true,
                                    pagination: false,
                                    navText: [],
                                    items : 4,
                                    margin: 30,
                                    responsive:{
                                        0:{ items:1 },
                                        600:{ items:2 },
                                        1000:{ items:3 },
                                        1200:{ items:4 }
                                    }
                                });


                            }); //ready

                        </script>

                    </div>
                    <!-- /row -->


                </div>
                <!-- /container -->



                <!-- ============ features section ============ -->
                <div class="section bg-lightred mb-0 section-slim" id="features">
                    <div class="container clearfix">

                        <!-- row -->
                        <div class="row">

                            <!-- col -->
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-phone icon-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="condensed text-uppercase mb-0">8 (812) 921-74-14</h2>
                                        <span class="text-uppercase">Помощь с выбором запчасти</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /col -->

                            <!-- col -->
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-truck icon-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="condensed text-uppercase mb-0">Быстрая доставка</h2>
                                        <span class="text-uppercase">По всей России</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /col -->

                            <!-- col -->
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-trophy icon-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="condensed text-uppercase mb-0">Работаем 7 лет</h2>
                                        <span class="text-uppercase">для вас</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /col -->

                        </div>
                        <!-- /row -->

                    </div>
                </div><!-- /features section -->
            </div>
        </section><!-- #content end -->

<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Купить запчасть в магазине Arparser</h4>
		  </div>
		  <div class="modal-body">
			Для покупки запчасти позвоните по телефону
			<a href="tel:88129217414">8 (812) 921-74-14</a>
			Наши специалисты помогут с выбором и проконсультируют по поводу принадлежности запчасти к вашему автомобилю.
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
		  </div>
		</div>
	  </div>
	</div>

@endsection