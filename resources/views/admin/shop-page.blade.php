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
                                    <a href="#"><i class="fa fa-home"></i> {{ $shop->name }} </a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>

                    <div class="pagecontent">



                        <div class="add-nav">
                            <div class="nav-heading">
                               <img src="{{ $shop->image }}" alt="" class="img-thumbnail" style="width:40px;">
                                <h3>{{ $shop->name }}<strong class="text-greensea"></strong></h3>
                                <span class="controls pull-right">
<!--                                  <a href="shop-products.html" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Back"><i class="fa fa-times"></i></a>-->
                                  <a href="{{ route('shop.partlink-page', [$shop->id]) }}" class="btn btn-primary btn-rounded-20 btn-ef btn-ef-5 btn-ef-5a mb-10"><i class="fa fa-link"></i> <span>Ссылки на Дром</span></a>
                                  <a href="{{ route('product.create.page',[$shop->id]) }}" class="btn btn-success btn-rounded-20 btn-ef btn-ef-5 btn-ef-5a mb-10"><i class="fa fa-plus"></i> <span>Добавить товар</span></a>
                                  <a href="{{ route('extrawords.table', [$shop->id]) }}" class="btn btn-warning btn-rounded-20 btn-ef btn-ef-5 btn-ef-5a mb-10"><i class="fa fa-pen"></i> <span>Лишний текст</span></a>
<!--                                  <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-danger btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>-->
<!--                                  <a href="{{ route('product.create.page',[$shop->id]) }}" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Добавить товар"><i class="fa fa-plus"></i></a>-->
                                </span>
                            </div>

                            <div role="tabpanel">
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Товары магазина</a></li>
                                    <li role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">Редактировать информацию</a></li>
                                    <li role="presentation"><a href="#allparts" aria-controls="allparts" role="tab" data-toggle="tab">Добавить товары из каталога</a></li>
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
												<section class="tile">

													<!-- tile header -->
													<div class="tile-header dvd dvd-btm">
														<h1 class="custom-font"><strong><a href="{{ route('products.table', [$shop->id])}}">Товары</a></strong></h1>
														<ul class="controls">
															<li><a href="{{ route('product.create.page',[$shop->id]) }}"><i class="fa fa-plus mr-5"></i> Новый товар</a></li>
															<li class="dropdown">

																<a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">Инструменты <i class="fa fa-angle-down ml-5"></i></a>

																<ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
																	<li>
																		<a href="{{ route('products.xml', [$shop->id]) }}">Экспортировать в XML для WP</a>
																	</li>
																	<li>
																		<a href="{{ route('shop.products-avito-xml', [$shop->id]) }}">Экспортировать в XML для Avito</a>
																	</li>
																	<!--
																	<li role="presentation" class="divider"></li>
																	<li>
																		<a href>Печать счетов-фактур</a>
																	</li>-->

																</ul>

															</li>
															<li class="dropdown">

																<a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">Очистка <i class="fa fa-angle-down ml-5"></i></a>

																<ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
																	<li>
																		<a href="{{ route('product.clean-all', [$shop->id]) }}">Очистить товары от ненужных слов</a>
																	</li>
																	<!--
																	<li role="presentation" class="divider"></li>
																	<li>
																		<a href>Печать счетов-фактур</a>
																	</li>-->

																</ul>

															</li>
															<li class="dropdown">

																<a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
																	<i class="fa fa-cog"></i>
																	<i class="fa fa-spinner fa-spin"></i>
																</a>

																<ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
																	<li>
																		<a role="button" tabindex="0" class="tile-toggle">
																			<span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Свернуть</span>
																			<span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Разваернуть</span>
																		</a>
																	</li>
																	<li>
																		<a role="button" tabindex="0" class="tile-refresh">
																			<i class="fa fa-refresh"></i> Обновить
																		</a>
																	</li>
																	<li>
																		<a role="button" tabindex="0" class="tile-fullscreen">
																			<i class="fa fa-expand"></i> Во весь экран
																		</a>
																	</li>
																</ul>

															</li>
															<li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
														</ul>
													</div>
													<!-- /tile header -->

													<!-- tile body -->
													<div class="tile-body">

														<div class="table-responsive">
															<table class="table table-striped table-hover table-custom" id="products-list">
																<thead>
																<tr>
																   <!--
																	<th style="width:40px;" class="no-sort">
																		<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0">
																			<input type="checkbox" id="select-all"><i></i>
																		</label>
																	</th>-->
																	<th style="width:90px;">Картинка</th>
																	<th>Название</th>
																	<th>Описание и модели</th>
																	<th></th>
																</tr>
																</thead>
																<tbody>
															  @foreach ($products as $product)
																<tr>
																  <td><img src="{{ $product->image }}" alt="" class="img-thumbnail" style="width:50px;"></td>
																  <td>
																	  <a href="{{ route('product.page',[$shop->id, $product->id]) }}">
																		  <small>
																			{{ $product->name }}
																		  </small>
																	  </a>
																  </td>
																  <td>
																	  	@if ($product->description != NULL)
																	  	<small>
																			<b>Описание:</b> {{ $product->description }}
																		</small><br/>
																		@endif
																	  <small>
																		<b>Модели:</b> {{ $product->models }}
																	  </small><br/>
																  	
																  </td>
																  <td>
																  
																  	<a href="{{ route('product.original-name',[$shop->id, $product->id]) }}" class="btn btn-sm btn-success mb-5"> Обновить </a>
															  	
																  	<a href="{{ route('product.delete',[$shop->id, $product->id]) }}" class="btn btn-sm btn-danger"> Удалить </a>
																  	
																  </td>
																</tr>
																@endforeach
															  </tbody>
															</table>
														</div>
														{{ $products->links() }}

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


                                                        <form method='POST' class="form-horizontal ng-pristine ng-valid" role="form" action='{{ action('ShopController@ShopEdit', $shop->id) }}' enctype="multipart/form-data">
                                                            {{ csrf_field() }}

                                                            <div class="form-group">
                                                                <label for="id" class="col-sm-2 control-label">ID: </label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="id" placeholder="Item ID" value="{{ $shop->id }}" disabled="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 control-label">Название: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите название" value="{{ $shop->name }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                               <label for="file" class="col-sm-2 control-label">Картинка: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input id="file" type="file" name="image" multiple>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="information" class="col-sm-2 control-label">Основная информация: <span class="text-lightred text-md"></span></label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" rows="5" name="information" id="information" placeholder="Основная информация о магазине">
                                                                    {{ $shop->information }}
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="additional_information" class="col-sm-2 control-label">Основная информация: <span class="text-lightred text-md"></span></label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" rows="5" name="additional_information" id="additional_information" placeholder="Дополнительная информация о магазине">
                                                                    {{ $shop->additional_information }}
                                                                    </textarea>
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
                                    
                                    <!-- tab in tabs -->
                                    <div role="tabpanel" class="tab-pane" id="allparts">
                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                            				<div class="col-md-12">
												<!-- tile -->
												<section class="tile">

													<!-- tile header -->
													<div class="tile-header dvd dvd-btm">
														<h1 class="custom-font"><strong>Каталог</strong></h1>
														<ul class="controls">
															<li class="dropdown">

																<a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">Инструменты <i class="fa fa-angle-down ml-5"></i></a>
															</li>
															<li class="dropdown">

																<a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
																	<i class="fa fa-cog"></i>
																	<i class="fa fa-spinner fa-spin"></i>
																</a>

																<ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
																	<li>
																		<a role="button" tabindex="0" class="tile-toggle">
																			<span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Свернуть</span>
																			<span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Разваернуть</span>
																		</a>
																	</li>
																	<li>
																		<a role="button" tabindex="0" class="tile-refresh">
																			<i class="fa fa-refresh"></i> Обновить
																		</a>
																	</li>
																	<li>
																		<a role="button" tabindex="0" class="tile-fullscreen">
																			<i class="fa fa-expand"></i> Во весь экран
																		</a>
																	</li>
																</ul>

															</li>
															<li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
														</ul>
													</div>
													<!-- /tile header -->

													<!-- tile body -->
													<div class="tile-body">

														<div class="table-responsive">
															<table class="table table-striped table-hover table-custom" id="products-list">
																<thead>
																<tr>
																   <!--
																	<th style="width:40px;" class="no-sort">
																		<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0">
																			<input type="checkbox" id="select-all"><i></i>
																		</label>
																	</th>-->
																	<th>id</th>
																	<th></th>
																	<th style="width:90px;">Картинка</th>
																	<th>Название</th>
																	<th>Модели</th>
																	<th style="width:80px;">Описание</th>
																	<th style="width:160px;">Категория на Авито</th>
																	<th style="width:90px;">Цена</th>
																	<th style="width:150px;" class="no-sort">Двигатели</th>
																	<th>Номер</th>
																	<th>Ссылка</th>
																</tr>
																</thead>
																<tbody>
															  @foreach ($parts as $part)
																<tr>
																  <th scope="row">
																	{{ $part->id }}
																  </th>
																  <td><a href="{{ route('part.to.shop',[$part->id, $shop->id]) }}">Добавить деталь</a></td>
																  <td><img src="{{ $part->image }}" alt="" class="img-thumbnail" style="width:50px;"></td>
																  <td>
																	  <a href="{{ route('part.page',[$part->id]) }}">
																		  <small>
																			{{ $part->titleOfAd }}
																		  </small>
																	  </a>
																  </td>
																  <td>
																  <p>
																	<small>
																		{{ $part->models }}
																	</small>
																  </p>
																  </td>
																  <td>{{ $part->part_description }}</td>
																  <td>{{ $part->avito_category }}</td>
																  <td>
																	{{ $part->price }} <br>
																	<small>
																		до парсера: {{ $part->price_main }}
																	</small>

																  </td>
																  <td>{{ $part->parsed_engine }}</td>
																  <td>{{ $part->number }}</td>
																  <td><a href="{{ $part->link }}">DROM.ru</a></td>
																</tr>
																@endforeach
															  </tbody>
															</table>
														</div>
														{{ $parts->links() }}

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

