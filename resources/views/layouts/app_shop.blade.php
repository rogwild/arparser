<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />





    <!-- ============================================
    ================= Stylesheets ===================
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic|Raleway:300,400,500,600,700|Open+Sans+Condensed:700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('shop_assets/css/bootstrap.min.css') }}"  media="all" type="text/css" />
    <link rel="stylesheet" href="{{ asset('shop_assets/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('shop_assets/css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('shop_assets/js/vendor/flexslider/flexslider.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('shop_assets/js/vendor/magnific/magnific-popup.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('shop_assets/js/vendor/owl/assets/owl.carousel.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('shop_assets/js/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('shop_assets/js/vendor/range-slider/css/styles.css') }}" type="text/css" />

    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('shop_assets/js/vendor/rs-plugin/css/settings.css') }}" media="screen" />

    <!-- animsition CSS -->
    <link rel="stylesheet" href="{{ asset('shop_assets/js/vendor/animsition/css/animsition.min.css') }}">



    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/jquery-1.11.2.min.js') }}"></script>






    <!-- ============================================
    ============= Main App Stylesheet ===============
    ============================================= -->

    <link rel="stylesheet" href="{{ asset('shop_assets/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('shop_assets/css/arparser-style.css') }}" type="text/css" />







    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if lt IE 9]>
    	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->









    <!-- ============================================
    ================== Page Title ===================
    ============================================= -->

    <title>Arparser | @yield('title')</title>







</head>

<body>








    <!-- ============================================
    ================= Page Wrapper ==================
    ============================================= -->

    <div id="wrapper" class="clearfix animsition">







        <!-- ================================================
        ================= Search Container ==================
        ================================================= -->

        <div id="search-container" class="search-box-wrapper">
            <div class="container">
                <i class="fa fa-search"></i>
                <div class="search-box">
                    <form action="http://example.com/" class="search-form" role="search" >
                        <input type="search" name="s" value="" title="Press Enter to submit your search" placeholder="Search…" class="search-field">
                        <input type="submit" value="Search" class="search-submit">
                    </form>
                </div>
            </div>
        </div><!--/ #search-container -->








        <!-- ==================================================
        ================= Additional Navbar ===================
        =================================================== -->

        <nav id="add-navbar">

            <div class="container clearfix">

			   <ul class="pull-right">
                    <li><a href="https://masterhub4x4.ru/">MasterHub4x4</a></li>
                    <li><a href="https://rockettools.ru/">Rocket Tools</a></li>
                    <li><a href="https://www.instagram.com/jdmstore_spb/">JDMstore</a></li>
                </ul>

                <ul class="divided">
                    <li><i class="fa fa-phone mr-5"></i> <span>8 (812) 921-74-14</span></li>
                    <!--
                    <li><a href="#" class="active mr-5">€</a><a href="#" class="mr-5">$</a><a href="#">£</a></li>
                    <li class="dropdown"><a href="#">English</a>
                        <ul>
                            <li><a href="#">Deutch</a></li>
                            <li><a href="#">Espanol</a></li>
                            <li><a href="#">Russian</a></li>
                        </ul>
                    </li>-->
                </ul>

            </div>

        </nav><!-- #add-navbar end -->








        <!-- ============================================
        ==================== Header =====================
        ============================================= -->

        <header id="header" class="dark"><!-- class .sticky-mobile makes header sticky on small devices -->

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="main-navbar-toggle"><i class="fa fa-bars"></i></div>







                    <!-- ============================================
                    =================== Branding ====================
                    ============================================= -->

                    <div id="branding">
                        <a href="{{ route('shop.main.page') }}" class="brand-normal"><img src="{{ asset('shop_assets/images/logo-dark.png') }}" alt="Arparser"></a>
                        <a href="{{ route('shop.main.page') }}" class="brand-retina"><img src="{{ asset('shop_assets/images/logo@2x-dark.png') }}" alt="Arparser"></a>
                    </div><!-- #branding end -->










                    <!-- ============================================
                    ================= Main Navbar ===================
                    ============================================= -->

                    <nav id="main-navbar">

                        <ul>
                            <li class="active"><a href="{{ route('shop.main.page')}}">Главная</a></li>
                            <li><a href="{{ route('shop.all.parts.page') }}">Все товары</a>
                                <!--<ul>
                                    <li><a href="#">Shoes</a>
                                        <ul>
                                            <li><a href="product-list.html">Boots</a></li>
                                            <li><a href="product-list.html">Sandals</a></li>
                                            <li><a href="product-list.html">Flats</a></li>
                                            <li><a href="product-list.html">Wedges</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="product-list.html">Dresses</a></li>
                                    <li><a href="product-list.html">Tops</a></li>
                                    <li><a href="product-list.html">Coats & Jackets</a></li>
                                    <li><a href="product-list.html">Skirts</a></li>
                                </ul>-->
                            </li>
                            <!--
                            <li class="mega-menu"><a href="#">Man</a>
                                <div class="mega-menu-content col-4">
                                    <ul>
                                        <li class="mega-menu-title"><a href="#">Clothing</a>
                                            <ul>
                                                <li><a href="product-list.html">T-Shirts & Vests</a></li>
                                                <li><a href="product-list.html">Jumpers & Cardigans</a></li>
                                                <li><a href="product-list.html">Sportswear</a></li>
                                                <li><a href="product-list.html">Hoodies & Sweats</a></li>
                                                <li><a href="product-list.html">Coats & Jaskets</a></li>
                                                <li><a href="product-list.html">Shirts</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="mega-menu-title"><a href="product-list.html">Shoes</a>
                                            <ul>
                                                <li><a href="product-list.html">Boots</a></li>
                                                <li><a href="product-list.html">Trainers</a></li>
                                                <li><a href="product-list.html">High Tops</a></li>
                                                <li><a href="product-list.html">Plimsolls</a></li>
                                                <li><a href="product-list.html">Desert Boots</a></li>
                                                <li><a href="product-list.html">Boat Shoes</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="mega-menu-title"><a href="product-list.html">Accessories</a>
                                            <ul>
                                                <li><a href="product-list.html">Beanie</a></li>
                                                <li><a href="product-list.html">Belts</a></li>
                                                <li><a href="product-list.html">Boxers</a></li>
                                                <li><a href="product-list.html">Bracelets</a></li>
                                                <li><a href="product-list.html">Sunglasses</a></li>
                                                <li><a href="product-list.html">Gloves</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="mega-menu-title"><a href="#">Clearance</a>
                                            <ul>
                                                <li><a href="product-list.html">Coats & Jackets</a></li>
                                                <li><a href="product-list.html">T- Shirts & Vests</a></li>
                                                <li><a href="product-list.html">Shorts & Swimwear</a></li>
                                                <li><a href="product-list.html">Jumpers & Cardigans</a></li>
                                                <li><a href="product-list.html">Shirts</a></li>
                                                <li><a href="product-list.html">Jeans</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="product-list.html">Kids</a></li>
                            <li class="mega-menu"><a href="#">Hot</a>
                                <div class="row mega-menu-content product-list">
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <article class="product-card">
                                            <div class="product-image">
                                                <a href="product.detail.html"><img src="{{ asset('shop_assets/images/items/woman/1.jpg') }}" alt=""></a>
                                            </div>
                                            <div class="product-detail">
                                                <h4><a href="product-detail.html">White T-Shirt</a></h4>
                                                <span class="price">$12.99</span>
                                                <button class="add-to-cart"><i class="fa fa-angle-right"></i> Add to cart</button>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <article class="product-card">
                                            <div class="product-image">
                                                <a href="product.detail.html"><img src="{{ asset('shop_assets/images/items/men/1.jpg') }}" alt=""></a>
                                            </div>
                                            <div class="product-detail">
                                                <h4><a href="product-detail.html">Black T-Shirt</a></h4>
                                                <span class="price">$13.99</span>
                                                <button class="add-to-cart"><i class="fa fa-angle-right"></i> Add to cart</button>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <article class="product-card">
                                            <div class="product-image">
                                                <a href="product.detail.html"><img src="{{ asset('shop_assets/images/items/woman/3.jpg') }}" alt=""></a>
                                            </div>
                                            <div class="product-detail">
                                                <h4><a href="product-detail.html">Red T-Shirt</a></h4>
                                                <span class="price">$11.99</span>
                                                <button class="add-to-cart"><i class="fa fa-angle-right"></i> Add to cart</button>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <article class="product-card">
                                            <div class="product-image">
                                                <a href="product.detail.html"><img src="{{ asset('shop_assets/images/items/woman/4.jpg') }}" alt=""></a>
                                            </div>
                                            <div class="product-detail">
                                                <h4><a href="product-detail.html">Blue T-Shirt</a></h4>
                                                <span class="price">$12.99</span>
                                                <button class="add-to-cart"><i class="fa fa-angle-right"></i> Add to cart</button>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#">Pages</a>
                                <ul>
                                    <li><a href="product-list.html">Product List</a></li>
                                    <li><a href="product-detail.html">Product Detail</a></li>
                                    <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="account.html">My Account</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="search-result.html">Search Result</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                </ul>
                            </li>-->
                        </ul>







                        <!-- ==============================================
                        ================= Shopping Cart ===================
                        =============================================== -->
                        <!--
                        <div id="shopping-cart">
                            <a href="#" id="shopping-cart-trigger"><i class="fa fa-shopping-cart"></i><span class="badge">2</span></a>
                            <div class="cart-content">
                                <div class="cart-title">
                                    <h4>Shopping Cart</h4>
                                </div>
                                <ul class="cart-items">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="product-detail.html">
                                                <img class="media-object thumb-w" alt="" src="{{ asset('shop_assets/images/items/woman/1_thumb.jpg') }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><a href="product-detail.html">White T-Shirt</a> <span class="quantity">x 2</span></p>
                                            <p class="price">$14.99</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="product-detail.html">
                                                <img class="media-object thumb-w" alt="" src="{{ asset('shop_assets/images/items/woman/2_thumb.jpg') }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><a href="product-detail.html">Red T-Shirt</a> <span class="quantity">x 1</span></p>
                                            <p class="price">$12.99</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="cart-actions clearfix">
                                    <span class="price pull-left">$69.22</span>
                                    <a href="shopping-cart.html" class="myBtn myBtn-3d myBtn-sm pull-right">View Cart</a>
                                </div>
                            </div>
                        </div>--><!-- #shopping-cart end -->








                        <!-- ==============================================
                        ================= Search Toggle ===================
                        =============================================== -->

                        <!--<div id="search-toggle"> <span class="divider">|</span> <a href="#"><i class="fa fa-search"></i></a> </div>-->







                    </nav><!-- #main-navbar end -->

                </div>

            </div>

        </header><!-- #header end -->










        @yield('content')










        <!-- ============================================
        ==================== Footer =====================
        ============================================= -->

        <footer id="footer">

            <div class="footer-main">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4">

                            <div class="widget widget-about">
                                <h4><strong>О</strong> Нас</h4>
                                <p>Мы работаем на стыке продажи автомобильных запчастей и информационных технологий. </p>

                                <p>Наша цель - оптимизировать процесс покупки автозапчастей.</p>
                            </div>

                        </div>

                        <div class="col-md-3 col-md-offset-1">

                            <div class="widget widget-menu mb-0">

                                <h4><strong>Информация</strong></h4>
                                <ul class="list-unstyled">
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Delivery Informations</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Payment Informations</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> FAQ</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Contacts</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Career</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Order Tracking</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Customer Service</a></li>
                                </ul>

                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="widget widget-contact mt-20-md">
                                <h4><strong>Наши контакты</strong></h4>
                                <address>
                                    <strong>Санкт-Петербург</strong><br>
                                    ул. Планерная, дом 15Б<br>
                                    секция 13<br/><br/>
                                    <strong>Телефон:</strong> <a href="tel:88129217414">8 (812) 921-74-14</a><br>
                                </address>
                            </div>
                        </div>

                    </div>

                    <div class="line"></div>

                    <!-- row -->
                    <div class="row">

                        <!-- col -->
                        <div class="col-md-6">
                            <!--<div class="widget mb-0">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Newsletter</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="email" class="form-control no-border" placeholder="Enter your Email" required>
                                                <span class="input-group-btn">
                                                    <button class="myBtn" type="submit">Subscribe</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>-->
                        </div>
                        <!-- /col -->

                        <!-- col -->
                        <div class="col-md-6 text-right text-center-md">

                            <a class="social-icon social-facebook" href="#">
                                 <div class="front">
                                    <i class="fa fa-facebook"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-facebook"></i>
                                 </div>
                            </a>

                            <a class="social-icon social-twitter" href="#">
                                 <div class="front">
                                    <i class="fa fa-twitter"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-twitter"></i>
                                 </div>
                            </a>

                            <a class="social-icon social-googleplus" href="#">
                                 <div class="front">
                                    <i class="fa fa-google-plus"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-google-plus"></i>
                                 </div>
                            </a>

                            <a class="social-icon social-pinterest" href="#">
                                 <div class="front">
                                    <i class="fa fa-pinterest"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-pinterest"></i>
                                 </div>
                            </a>

                            <a class="social-icon social-flickr" href="#">
                                 <div class="front">
                                    <i class="fa fa-flickr"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-flickr"></i>
                                 </div>
                            </a>

                            <a class="social-icon social-linkedin" href="#">
                                 <div class="front">
                                    <i class="fa fa-linkedin"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-linkedin"></i>
                                 </div>
                            </a>

                            <a class="social-icon social-dribbble" href="#">
                                 <div class="front">
                                    <i class="fa fa-dribbble"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-dribbble"></i>
                                 </div>
                            </a>

                        </div>
                        <!-- /col -->

                    </div>
                    <!-- /row -->

                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4 copyright">
                            <p class="mb-0">&copy; 2018 <a href="http://avtorazvitie.ru/">Авторазвитие ДВ</a>. Все права защищены.</p>
                            <p>Разработано <a href="https://flakedesign.ru/">Flake</a></p>
                        </div>

                        <div class="col-md-8 text-right text-center-md">

                            <ul class="list-unstyled list-inline">
                                <li class="payment-method"><img src="{{ asset('shop_assets/images/icons/payments/1.png') }}" alt=""></li>
                                <li class="payment-method"><img src="{{ asset('shop_assets/images/icons/payments/2.png') }}" alt=""></li>
                                <li class="payment-method"><img src="{{ asset('shop_assets/images/icons/payments/3.png') }}" alt=""></li>
                                <li class="payment-method"><img src="{{ asset('shop_assets/images/icons/payments/4.png') }}" alt=""></li>
                                <li class="payment-method"><img src="{{ asset('shop_assets/images/icons/payments/5.png') }}" alt=""></li>
                            </ul>

                        </div>

                    </div>
                </div>
            </div>

        </footer><!-- #footer end -->

    </div><!-- #wrapper end -->











    <!-- ============================================
    =================== Go to Top ===================
    ============================================= -->

    <div id="gotoTop" class="fa fa-angle-up hidden-md"></div>










    <!-- ============================================
    ============== Vendor JavaScripts ===============
    ============================================= -->
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/jquery-1.11.2.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/superfish/js/superfish.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/jRespond/jRespond.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/smoothscroll/SmoothScroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/appear/jquery.appear.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/stellar/jquery.stellar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/flexslider/jquery.flexslider-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/magnific/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/owl/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/jflickrfeed/jflickrfeed.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/tweet-js/jquery.tweet.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/countTo/jquery.countTo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/range-slider/js/plugin.js') }}"></script>

    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

    <!-- animsition js -->
    <script src="{{ asset('shop_assets/js/vendor/animsition/js/jquery.animsition.min.js') }}"></script>







    <!-- ============================================
    ============== Custom JavaScripts ===============
    ============================================= -->


    <script type="text/javascript" src="{{ asset('shop_assets/js/global.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('shop_assets/js/vendor/salvattore.js') }}"></script>


</body>
</html>