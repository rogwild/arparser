@extends('layouts.app')

@section('content')
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-shop-single-product">

                    <div class="pageheader">

                        <h2> <span> </span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="{{ route('shop.page',[$shop->id]) }}"><i class="fa fa-home"></i> {{ $shop->name }} </a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>

                    <div class="pagecontent">



                        <div class="add-nav">
                            <div class="nav-heading">
                               <img src="{{ $shop->image }}" alt="" class="img-thumbnail" style="width:40px;">
                                <h3>{{ $product->name }}<strong class="text-greensea"></strong></h3>
                                <span class="controls pull-right">
                                  <!--<a href="shop-products.html" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Back"><i class="fa fa-times"></i></a>
                                  <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-success btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Save"><i class="fa fa-check"></i></a>
                                  <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-danger btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>-->
                                  <a href="{{ route('product.delete',[$shop->id, $product->id]) }}" class="btn btn-ef btn-ef-1 btn-ef-1-danger btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Удалить"><i class="fa fa-trash"></i></a>
                                </span>
                            </div>

                            <div role="tabpanel">
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Информация о товаре</a></li>
                                    <li role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">Редактировать информацию</a></li>
                                    <!--
                                    <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Картинки</a></li>
                                    <li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Отзывы</a></li>
                                    <li role="presentation"><a href="#historyTab" aria-controls="history" role="tab" data-toggle="tab">История</a></li>-->
                                </ul>
         
                                <div class="tab-content">
                                    <!-- tab in tabs -->
                                    <div role="tabpanel" class="tab-pane active" id="details">



                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12">

                                                <!-- tile -->
                                                <section class="tile time-simple">

                                                    <!-- tile body -->
                                                    <div class="tile-body">


                                                        <!-- row -->
                                                        <div class="row">

                                                            <!-- col -->
                                                            <div class="col-md-4" data-lightbox="gallery">

                                                                <a href="#" class="img-link" data-lightbox="gallery-item">
                                                                    <img src="{{ $product->image }}" alt="" class="img-responsive mb-20">
                                                                </a>

                                                            </div>
                                                            <!-- /col -->

                                                            <!-- col -->
                                                            <div class="col-md-8">

                                                                <h2 class="custom-font mb-5">{{ $product->name }} <span class="label label-success">Available</span></h2>

                                                                <p class="short-desc text-sm text-default lt mb-20"></p>
                                                                <p class="desc text-default lt mb-20">{{ $product->description }}</p>
                                                                
                                                                <p class="short-desc text-sm text-default lt mb-0">Мета-теги:</p>
                                                                <p class="desc text-default lt mb-20">{{ $product->meta }}</p>

                                                                <p class="tags">
																	@foreach ($translations as $translation)
																		<span class="label label-default mr-5">{{ $translation }}</span>
																	@endforeach
                                                                </p>

                                                                <h3 class="price mt-40 mb-0 text-success ng-binding">{{ $product->price }} РУБЛЕЙ<small></small></h3>
                                                            </div>
                                                            <!-- /col -->

                                                        </div>
                                                        <!-- /row -->


                                                    </div>
                                                    <!-- /tile body -->

                                                </section>
                                                <!-- /tile -->

                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->


                                    </div>
                                    <!-- tab in tabs -->
                                    <div role="tabpanel" class="tab-pane" id="general">




                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12">


                                                <!-- tile -->
                                                <section class="tile">

                                                    <!-- tile header -->
                                                    <div class="tile-header dvd dvd-btm">
                                                        <h1 class="custom-font"><strong>Изменить </strong> Основную информацию</h1>
                                                    </div>
                                                    <!-- /tile header -->


                                                    <!-- tile body -->
                                                    <div class="tile-body">


                                                        <form method='POST' class="form-horizontal ng-pristine ng-valid" role="form" action='{{ action('ProductController@ProductEdit', [$shop->id, $product->id]) }}' enctype="multipart/form-data">
                                                            {{ csrf_field() }}

                                                            <div class="form-group">
                                                                <label for="id" class="col-sm-2 control-label">ID: </label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="id" placeholder="Item ID" value="{{ $product->id }}" disabled="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 control-label">Название: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите название" value="{{ $product->name }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                               <label for="file" class="col-sm-2 control-label">Картинка: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input id="file" type="file" name="image" multiple>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="description" class="col-sm-2 control-label">Описание: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" rows="5" name="description" id="description" placeholder="Write something about you...">
                                                                    {{ $product->description }}
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="models" class="col-sm-2 control-label">Модельный ряд: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="models" name="models" placeholder="Автомобили через запятую Toyota Crown" value="{{ $product->models }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="meta" class="col-sm-2 control-label">Теги (через запятую): <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="meta" name="meta" placeholder="Автомобили через запятую Toyota Crown" value="{{ $product->meta }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="price" class="col-sm-2 control-label">Цена: <span class="text-lightred text-md">{{ $product->price_main }}</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" value="{{ $product->price }}" id="price" class="form-control touchspin" data-min='0' data-max="100000" data-step="0.1" data-decimals="0" name="price" data-stepinterval="50" data-maxboostedstep="100000" data-prefix="РУБЛЕЙ">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                            	<div class="col-sm-offset-4 col-sm-4 text-center">
																	<button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-success btn-ef-1b mb-10">Сохранить</button>
																</div>
                                                            </div>
                                                            
                                                            

                                                        </form>


                                                    </div>
                                                    <!-- /tile body -->

                                                </section>
                                                <!-- /tile -->


                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->




                                    </div>
                                    <!-- end ngRepeat: tab in tabs -->
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
                
            </section>
            <!--/ CONTENT -->
@endsection
@section('scripts')
        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="{{ URL::asset('assets/assets/js/main.js') }}"></script>
        <!--/ custom javascripts -->




        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){


            });
        </script>
        <!--/ Page Specific Scripts -->
@endsection

