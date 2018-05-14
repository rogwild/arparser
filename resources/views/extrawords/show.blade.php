@extends('layouts.app')

@section('content')
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-shop-single-product">

                    <div class="pageheader">

                        <h2>{{ $word->title }} <span>  </span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> ARparser</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>

                    <div class="pagecontent">



                        <div class="add-nav">
                            <div class="nav-heading">
                                <h3><strong class="text-greensea">{{ $word->title }}</strong></h3>
                                <span class="controls pull-right">
                                  <!--<a href="shop-products.html" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Back"><i class="fa fa-times"></i></a>
                                  <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-success btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Save"><i class="fa fa-check"></i></a>
                                  <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-danger btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>-->
                                  
                                  <form action="{{ route('extrawords.delete', [$shop->id, $word->id]) }}" method="post">
										<input type="hidden" name="_method" value="DELETE" />
										{{ csrf_field() }}
										<button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-danger btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Удалить"><i class="fa fa-trash"></i></button>
								  </form>
                                </span>
                            </div>

                            <div role="tabpanel">
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">Основное</a></li>
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


                                                        <form method='POST' class="form-horizontal ng-pristine ng-valid" role="form" action='{{ action('ExtraWordsController@update', [$shop->id, $word->id]) }}'>
                                                            {{ csrf_field() }}
                                                            <input name="_method" type="hidden" value="PATCH">
                                                            <div class="form-group">
                                                                <label for="title" class="col-sm-2 control-label">{{ $word->title }}: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Название" value="{{ $word->title }}">
                                                                </div>
                                                            </div>
														 	<div class="form-group">
                                                                <label for="body" class="col-sm-2 control-label">Текст: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" rows="5" name="body" id="body" placeholder="Текст...">
                                                                    {{ $word->body }}
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
                                    <div role="tabpanel" class="tab-pane" id="meta">



                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12">


                                                <!-- tile -->
                                                <section class="tile">

                                                    <!-- tile header -->
                                                    <div class="tile-header dvd dvd-btm">
                                                        <h1 class="custom-font"><strong>Edit </strong> Meta Informations</h1>
                                                    </div>
                                                    <!-- /tile header -->


                                                    <!-- tile body -->
                                                    <div class="tile-body">


                                                        <form class="form-horizontal ng-pristine ng-valid" role="form">

                                                            <div class="form-group">
                                                                <label for="title" class="col-sm-2 control-label">Title:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="title" placeholder="Meta Title" value="Onions">
                                                                    <span class="help-block">max 100 chars</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="keywords" class="col-sm-2 control-label">Keywords:</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" id="keywords" placeholder="Meta Keywords" rows="8">vegetables, onions, healthly</textarea>
                                                                    <span class="help-block">max 1000 chars</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="mdescription" class="col-sm-2 control-label">Description:</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" id="mdescription" placeholder="Meta Description" rows="8">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</textarea>
                                                                    <span class="help-block">max 255 chars</span>
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
                                    <div role="tabpanel" class="tab-pane" id="images">




                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12">


                                                <!-- tile -->
                                                <section class="tile">

                                                    <!-- tile header -->
                                                    <div class="tile-header dvd dvd-btm">
                                                        <h1 class="custom-font"><strong>Edit </strong> Images</h1>
                                                        <ul class="controls">
                                                            <li><a href="javascript:;"><i class="fa fa-plus"></i> Add Image</a></li>
                                                        </ul>
                                                    </div>
                                                    <!-- /tile header -->


                                                    <!-- tile body -->
                                                    <div class="tile-body">

                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th style="width: 110px">Image</th>
                                                                    <th>Label</th>
                                                                    <th style="width: 130px">Order</th>
                                                                    <th>Base Image</th>
                                                                    <th>Small Image</th>
                                                                    <th>Thumbnail</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody data-lightbox="gallery">
                                                                <tr>
                                                                    <td>
                                                                        <a href="http://placekitten.com/g/800/600" class="img-link" data-lightbox="gallery-item">
                                                                            <img src="http://placekitten.com/g/800/600" alt="" class="thumb thumb-lg">
                                                                        </a>
                                                                    </td>
                                                                    <td><input type="text" class="form-control" placeholder="Image Label" value="Product thumbnail"></td>
                                                                    <td><input type="text" value="1" class="form-control touchspin" data-min='0' data-max="100" data-boostat="5" data-maxboostedstep="10"></td>
                                                                    <td>
                                                                        <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                                                                            <input name="product1" type="radio"><i></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                                                                            <input name="product1" type="radio"><i></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                                                                            <input name="product1" type="radio" checked=""><i></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <a href="http://placekitten.com/g/800/601" class="img-link" data-lightbox="gallery-item">
                                                                            <img src="http://placekitten.com/g/800/601" alt="" class="thumb thumb-lg">
                                                                        </a>
                                                                    </td>
                                                                    <td><input type="text" class="form-control" placeholder="Image Label" value="Product Image 1"></td>
                                                                    <td><input type="text" value="1" class="form-control touchspin" data-min='0' data-max="100" data-boostat="5" data-maxboostedstep="10"></td></td>
                                                                    <td>
                                                                        <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                                                                            <input name="product2" type="radio" checked=""><i></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                                                                            <input name="product2" type="radio"><i></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                                                                            <input name="product2" type="radio"><i></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <a href="http://placekitten.com/g/800/602" class="img-link" data-lightbox="gallery-item">
                                                                            <img src="http://placekitten.com/g/800/602" alt="" class="thumb thumb-lg">
                                                                        </a>
                                                                    </td>
                                                                    <td><input type="text" class="form-control" placeholder="Image Label" value="Product Image 2"></td>
                                                                    <td><input type="text" value="1" class="form-control touchspin" data-min='0' data-max="100" data-boostat="5" data-maxboostedstep="10"></td></td>
                                                                    <td>
                                                                        <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                                                                            <input name="product3" type="radio"><i></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                                                                            <input name="product3" type="radio" checked=""><i></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                                                                            <input name="product3" type="radio"><i></i>
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

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
                                    <div role="tabpanel" class="tab-pane" id="reviews">





                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12">



                                                <!-- tile -->
                                                <section class="tile">

                                                    <!-- tile header -->
                                                    <div class="tile-header dvd dvd-btm">
                                                        <h1 class="custom-font"><strong>Product </strong> Reviews</h1>
                                                    </div>
                                                    <!-- /tile header -->

                                                    <!-- tile body -->
                                                    <div class="tile-body p-0">

                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Rating</th>
                                                                    <th>Review Date</th>
                                                                    <th>Customer</th>
                                                                    <th>Content</th>
                                                                    <th>Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td><a href="javascript:;">1</a></td>
                                                                    <td><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star-half-o text-orange"></i><i class="fa fa-star-o"></i></td>
                                                                    <td>Jan 20, 2015</td>
                                                                    <td>Customer 1</td>
                                                                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                                                    <td><span class="label label-success">approved</span></td>
                                                                    <td>
                                                                        <a href="javascript:;" class="btn btn-xs btn-default"><i class="fa fa-search"></i> View</a>
                                                                        <a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="javascript:;">2</a></td>
                                                                    <td><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star-half-o text-orange"></i><i class="fa fa-star-o"></i></td>
                                                                    <td>Jan 20, 2015</td>
                                                                    <td>Customer 2</td>
                                                                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                                                    <td><span class="label label-success">approved</span></td>
                                                                    <td>
                                                                        <a href="javascript:;" class="btn btn-xs btn-default"><i class="fa fa-search"></i> View</a>
                                                                        <a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="javascript:;">3</a></td>
                                                                    <td><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star-half-o text-orange"></i><i class="fa fa-star-o"></i></td>
                                                                    <td>Jan 21, 2015</td>
                                                                    <td>Customer 3</td>
                                                                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                                                    <td><span class="label label-warning">pending</span></td>
                                                                    <td>
                                                                        <a href="javascript:;" class="btn btn-xs btn-default"><i class="fa fa-search"></i> View</a>
                                                                        <a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="javascript:;">4</a></td>
                                                                    <td><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star-half-o text-orange"></i><i class="fa fa-star-o"></i></td>
                                                                    <td>Jan 21, 2015</td>
                                                                    <td>Customer 4</td>
                                                                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                                                    <td><span class="label label-danger">rejected</span></td>
                                                                    <td>
                                                                        <a href="javascript:;" class="btn btn-xs btn-default"><i class="fa fa-search"></i> View</a>
                                                                        <a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="javascript:;">5</a></td>
                                                                    <td><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star text-orange"></i><i class="fa fa-star-half-o text-orange"></i><i class="fa fa-star-o"></i></td>
                                                                    <td>Jan 21, 2015</td>
                                                                    <td>Customer 5</td>
                                                                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                                                    <td><span class="label label-danger">rejected</span></td>
                                                                    <td>
                                                                        <a href="javascript:;" class="btn btn-xs btn-default"><i class="fa fa-search"></i> View</a>
                                                                        <a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

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
                                    <div role="tabpanel" class="tab-pane" id="historyTab">





                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12">





                                                <!-- tile -->
                                                <section class="tile tile">

                                                    <!-- tile header -->
                                                    <div class="tile-header dvd dvd-btm">
                                                        <h1 class="custom-font"><strong>Product </strong> History</h1>
                                                    </div>
                                                    <!-- /tile header -->

                                                    <!-- tile body -->
                                                    <div class="tile-body p-0">

                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Desription</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td><a href="javascript:;">1</a></td>
                                                                    <td>Product Created</td>
                                                                    <td>Jan 20, 2015</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="javascript:;">2</a></td>
                                                                    <td>Product is available</td>
                                                                    <td>Jan 20, 2015</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="javascript:;">3</a></td>
                                                                    <td>Product updated</td>
                                                                    <td>Jan 21, 2015</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="javascript:;">4</a></td>
                                                                    <td>Product is unavailable</td>
                                                                    <td>Jan 21, 2015</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <!-- /tile body -->

                                                </section>
                                                <!-- /tile -->


                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->




                                    </div><!-- end ngRepeat: tab in tabs -->
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

