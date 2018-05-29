@extends('layouts.app')

@section('content')
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-forms-common">

                    <div class="pageheader">

                        <h2>{{ $shop->name }}<span></span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="#"><i class="fa fa-home"></i> </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.page', [$shop->id]) }}">Магазин</a>
                                </li>
                                <li>
                                    <a href="#">Добавить ссылку на магазин</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>


                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Парсер деталей</strong> </h1>
                                    <ul class="controls">
                                        <li class="dropdown">

                                            <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                                <i class="fa fa-cog"></i>
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </a>

                                            <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-toggle">
                                                        <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                                                        <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-refresh">
                                                        <i class="fa fa-refresh"></i> Refresh
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-fullscreen">
                                                        <i class="fa fa-expand"></i> Fullscreen
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

                                    <form method='POST' action='{{ $action }}' class="form-horizontal" role="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        
                                        <div class="form-group">
											<label for="name" class="col-sm-2 control-label">{{ $shop->name }}: <span class="text-lightred text-md">*</span></label>
											<div class="col-sm-10">
												<input name="html" type="text" required class="form-control" placeholder="https://baza.drom.ru/user/{{ $shop->name }}">
												<span class="help-block mb-0">{{ $description }}</span>
											</div>
										</div>
										<hr class="line-dashed line-full">
									  <div class="row">
									  	<div class="col-sm-offset-2 col-sm-8">
									  		<p>
									  			<strong>Границы работы парсера</strong>
									  		</p>
									  	</div>
									  </div>
                                   
                                   		<div class="form-group">
											<label for="startpage" class="col-sm-2 control-label">Начать со страницы: <span class="text-lightred text-md"></span></label>
											<div class="col-sm-10">
												<input name="startpage" type="nubmer" class="form-control" placeholder="5">
												<span class="help-block mb-0">Парсер начнет работать с этой страницы</span>
											</div>
										</div>
                                   
                                   <div class="form-group">
											<label for="endpage" class="col-sm-2 control-label">До страницы: <span class="text-lightred text-md"></span></label>
											<div class="col-sm-10">
												<input name="endpage" type="nubmer" class="form-control" placeholder="19">
												<span class="help-block mb-0">Парсер закончит работать на этой странице</span>
											</div>
										</div>
                                   
                                   <div class="form-group">
											<label for="keyword" class="col-sm-2 control-label">Ключевое слово: <span class="text-lightred text-md"></span></label>
											<div class="col-sm-10">
												<input name="keyword" type="text" class="form-control" placeholder="{{ $shop->name }} |">
												<span class="help-block mb-0">Генерируется в строке состояния при вводе поиска по нему на Drom, в формате UNICODE (%EA%EE%EC%EF%F0%E5%F1%F1%EE%F0 или JDMstore)</span>
											</div>
										</div>
                                    
										<div class="row">
											<div class="col-sm-offset-4 col-sm-4 text-center">
												<button type="submit" class="btn btn-ef btn-ef-1 btn-ef-1-success btn-ef-1b mb-10">Начать</button>
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
                
            </section>
            <!--/ CONTENT -->
@endsection
@section('scripts')
        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){
                $('#ex1').slider({
                    formatter: function(value) {
                        return 'Current value: ' + value;
                    }
                });
                $("#ex1").on("slide", function(slideEvt) {
                    $("#ex1SliderVal").text(slideEvt.value);
                });

                $("#ex2, #ex3, #ex4, #ex5").slider();

                //load wysiwyg editor
                $('#summernote').summernote({
                    height: 200   //set editable area's height
                });
                //*load wysiwyg editor
            });
        </script>
        <!--/ Page Specific Scripts -->
@endsection

