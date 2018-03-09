@extends('layouts.app')

@section('content')
           
           
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-shop-single-product">

                    <div class="pageheader">

                        <h2>Создание категории<span>  </span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="{{ route('admin.home') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">Категории</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>

                    <div class="pagecontent">



                        <div class="add-nav">
                            <div class="nav-heading">
                                <h3>Создать<strong class="text-greensea"> новую категорию</strong></h3>
                                <span class="controls pull-right">
                                  <a href="#" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Назад"><i class="fa fa-times"></i></a>
                                </span>
                            </div>

                            <div role="tabpanel">
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">Создать</a></li>
                                    <!--
                                    <li role="presentation"><a href="#meta" aria-controls="meta" role="tab" data-toggle="tab">Мета</a></li>
                                    <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Картинки</a></li>
                                    <li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Отзывы</a></li>
                                    <li role="presentation"><a href="#historyTab" aria-controls="history" role="tab" data-toggle="tab">История</a></li>-->
                                </ul>
         
                                <div class="tab-content">
                                    <!-- tab in tabs -->
                                    <div role="tabpanel" class="tab-pane active" id="general">
                                        
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


                                                        <form method='POST' class="form-horizontal ng-pristine ng-valid" role="form" action='{{ action('CategoryController@CategoryCreate') }}' enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            
                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 control-label">Название: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите название категории">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                               <label for="slug" class="col-sm-2 control-label">На английском (camshaft-
                                                              timing-belt): <span class="text-lightred text-md">*</span></label>
                                                               <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Введите название категории на английском, заменив пробелы на тирэ -">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
																<label class="col-sm-2 control-label" for="parent">Родительская категория:<span class="text-lightred text-md">*</span></label>
																<div class="col-sm-10">

																	<select id="parent" name="parent" class="form-control mb-10">
																		<option value="0">
																			Нет родительской категории
																		</option>
																		@foreach ($categories as $category)
																			<option value="{{ $category->id }}">
																				{{ $category->name }}
																			</option>
																		@endforeach
																	</select>

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

