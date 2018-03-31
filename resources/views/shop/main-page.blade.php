@extends('layouts.app_shop')
@section('title', $title)
@section('content')

        <!-- ============================================
        ==================== Slider =====================
        ============================================= -->

        <section id="slider" class="slider-parallax">

            <!--
            #################################
                - THEMEPUNCH BANNER -
            #################################
            -->

            <div class="tp-banner-container">

                <div class="tp-banner" >

                    <ul>

                        <!-- SLIDE  -->
                        <li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="{{ asset('shop_assets/images/slider/arparser-slider-1-cube.jpg') }}">

                            <!-- MAIN IMAGE -->
                            <img src="{{ asset('shop_assets/images/slider/arparser-slider-1-wide.jpg') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">

                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption black_thin_blackbg_30 lft fadeout"
                                data-x="120"
                                data-y="220"
                                data-speed="800"
                                data-start="1000"
                                data-easing="easeOutQuad"
                                data-endspeed="1000"
                                data-endeasing="Power4.easeIn" style="white-space: normal;">{{ $slide1_name }}
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption big-text skewfromleft fadeout"
                                data-x="150"
                                data-y="300"
                                data-speed="800"
                                data-start="1000"
                                data-easing="easeOutQuad"
                                data-endspeed="1000"
                                data-endeasing="Power4.easeIn" style="color: #fff;">
                            </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption light_normal_22 text-center skewfromright fadeout"
                                data-x="210"
                                data-y="400"
                                data-speed="800"
                                data-start="1000"
                                data-easing="easeOutQuad"
                                data-endspeed="1000"
                                data-endeasing="Power4.easeIn" style="width: 680px; max-width: 680px; white-space: normal; color: #fff;">
                            </div>


                        </li>


                    </ul>

                </div>

                <script type="text/javascript">

                    $(document).ready(function() {

                        var apiRevoSlider = $('.tp-banner').show().revolution(
                                {
                                    dottedOverlay:"none",
                                    delay:9000,
                                    startwidth:1140,
                                    startheight:700,
                                    hideThumbs:200,

                                    thumbWidth:100,
                                    thumbHeight:50,
                                    thumbAmount:3,

                                    navigationType:"none",
                                    navigationArrows:"solo",
                                    navigationStyle:"preview1",

                                    touchenabled:"on",
                                    onHoverStop:"on",

                                    swipe_velocity: 0.7,
                                    swipe_min_touches: 1,
                                    swipe_max_touches: 1,
                                    drag_block_vertical: false,


                                    parallax:"mouse",
                                    parallaxBgFreeze:"on",
                                    parallaxLevels:[8,7,6,5,4,3,2,1],
                                    parallaxDisableOnMobile:"on",


                                    keyboardNavigation:"on",

                                    navigationHAlign:"center",
                                    navigationVAlign:"bottom",
                                    navigationHOffset:0,
                                    navigationVOffset:20,

                                    soloArrowLeftHalign:"left",
                                    soloArrowLeftValign:"center",
                                    soloArrowLeftHOffset:20,
                                    soloArrowLeftVOffset:0,

                                    soloArrowRightHalign:"right",
                                    soloArrowRightValign:"center",
                                    soloArrowRightHOffset:20,
                                    soloArrowRightVOffset:0,

                                    shadow:0,
                                    fullWidth:"off",
                                    fullScreen:"on",

                                    spinner:"spinner3",

                                    stopLoop:"off",
                                    stopAfterLoops:-1,
                                    stopAtSlide:-1,

                                    shuffle:"off",

                                    forceFullWidth:"off",
                                    fullScreenAlignForce:"off",
                                    minFullScreenHeight:"400",

                                    hideThumbsOnMobile:"off",
                                    hideNavDelayOnMobile:1500,
                                    hideBulletsOnMobile:"off",
                                    hideArrowsOnMobile:"off",
                                    hideThumbsUnderResolution:0,

                                    hideSliderAtLimit:0,
                                    hideCaptionAtLimit:0,
                                    hideAllCaptionAtLilmit:0,
                                    startWithSlide:0,
                                    fullScreenOffsetContainer: ".header"
                                });

                        apiRevoSlider.bind("revolution.slide.onchange",function (e,data) {
                            if( $(window).width() > 992 ) {
                                if( $('#slider ul > li').eq(data.slideIndex-1).hasClass('light') ){
                                    $('#header:not(.sticky-header)').addClass('light');
                                } else {
                                    $('#header:not(.sticky-header)').removeClass('light');
                                }
                                MINOVATE.header.chooseLogo();
                            }
                        });

                    }); //ready

                </script>

            </div>
            <!-- END REVOLUTION SLIDER -->


        </section><!-- #slider end -->











        <!-- ============================================
        =================== Content =====================
        ============================================= -->

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                    <div class="row">


                        <!-- BEST SELLERS -->
                        <div class="col-sm-12">
                            <h6 class="text-bold text-uppercase mb-10">Новое поступление</h6>
                            <div class="row product-list masonry" data-columns>
                               @foreach ($new_parts as $part)
									<div class="item">
										<article class="product-card">
											<div class="product-offer hot-offer">Новинка</div>
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
												<h4><a href="product-detail.html">{{ $part->titleOfAd }}</a></h4>
												<span class="price">{{ $part->price }}</span>
												<button class="add-to-cart" data-toggle="modal" data-target="#myModal"><i class="fa fa-angle-right"></i> Купить</button>
											</div>
										</article>
									</div>
                                @endforeach
                            </div>
                        </div>
                        <!-- END BEST SELLERS -->

                    </div>
                    <!-- /row -->


                    <!-- row -->
                    <div class="row">

                        <!-- NEW ARRIVALS -->
                        <div class="col-md-12">
                            <h6 class="text-bold text-uppercase mb-10">Популярные товары</h6>

                            <div class="product-carousel owl-carousel" id="new-arrivals">
                            	@foreach ($popular_parts as $part)
									<div class="carousel-item">
										<article class="product-card">
											<div class="product-image two-sided">
												<img src="{{ $part->image }}" alt="">
												<img src="{{ $part->image }}" alt="">
												<div class="image-overlay" data-lightbox="gallery">
													<a href="{{ $part->image }}" data-lightbox="gallery-item"><i class="fa fa-search-plus"></i></a>
													<a href="{{ $part->image }}" class="hidden" data-lightbox="gallery-item"></a>
													<a href="product-detail.html"><i class="fa fa-ellipsis-h"></i></a>
												</div>
											</div>
											<div class="product-detail">
												<h4><a href="product-detail.html">{{ $part->titleOfAd }}</a></h4>
												<span class="price">{{ $part->price }}</span>
												<button class="add-to-cart" data-toggle="modal" data-target="#myModal"><i class="fa fa-angle-right"></i> Купить</button>
											</div>
										</article>
									</div>
                                @endforeach
                            </div>

                        </div>
                        <!-- /END NEW ARRIVALS -->

                        <script type="text/javascript">

                            $(document).ready(function() {

                                $('#new-arrivals').owlCarousel({
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



                <!-- ============ clients carousel section ============ -->
                <div id="clients-carousel" class="section bg-white owl-carousel carousel-full section-slim m-0">
 					
                   <!--
                    <div class="carousel-item"><a href="#" class="desaturate"><img src="{{ asset('shop_assets/images/clients/themeforest-light-background.png') }}" class="img-responsive" alt="Clients"></a></div> -->

                </div><!-- /clients carousel section -->


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

