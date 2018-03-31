@extends('layouts.app_shop')
@section('title', $title)
@section('content')

       
       <!-- ============================================
        =================== Breadcrumbs =================
        ============================================= -->
        <section id="breadcrumbs" class="breadcrumbs">

            <div class="container clearfix">
                <h1>{{ $title }}</h1>
                <span>Arparser</span>
                <ol class="breadcrumb">
                    <li><a href="{{ route('shop.main.page') }}">Главная</a></li>
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

                        


                        <!-- PRODUCT LIST -->
                        <div class="col-md-12 col-sm-12">

                            <div class="row product-list masonry" data-columns>
                            	@foreach ($parts as $part)
									<div class="item">
										<article class="product-card">
											<div class="product-offer hot-offer">{{ $part->category }}</div>
											<div class="product-image two-sided">
												<img src="{{ $part->image }}" alt="">
												<img src="{{ $part->image }}" alt="">
												<div class="image-overlay" data-lightbox="gallery">
													<a href="{{ $part->image }}" data-lightbox="gallery-item"><i class="fa fa-search-plus"></i></a>
													<a href="{{ $part->image }}" class="hidden" data-lightbox="gallery-item"></a>
													<a href="{{ route('shop.part.page',[$part->id]) }}"><i class="fa fa-ellipsis-h"></i></a>
												</div>
											</div>
											<div class="product-detail">
												<h4><a href="{{ route('shop.part.page',[$part->id]) }}">{{ $part->titleOfAd }}</a></h4>
												<span class="price">{{ $part->price }}</span>
												<button class="add-to-cart" data-toggle="modal" data-target="#myModal"><i class="fa fa-angle-right"></i> Купить</button>
											</div>
										</article>
									</div>
                                @endforeach
                            </div>
                            <!-- Пагинатор -->
                            {{ $parts->links() }}
                            <!-- END Пагинатор -->

                        </div>
                        <!-- END PRODUCT LIST -->

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
                


                <script type="text/javascript">

                    $(document).ready(function() {

                        var cCarousel = $("#clients-carousel");

                        cCarousel.owlCarousel({
                            loop: true,
                            nav: false,
                            autoplay:true,
                            autoplayTimeout:3000,
                            autoplayHoverPause:true,
                            pagination: false,
                            margin: 30,
                            responsive:{
                                0:{ items:1 },
                                600:{ items:2 },
                                1000:{ items:4 },
                                1200:{ items:5 },
                                1400:{ items:6 }
                            }
                        });


                    }); //ready

                </script>
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