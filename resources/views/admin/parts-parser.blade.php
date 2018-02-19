@extends('layouts.app')

@section('content')
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-forms-common">

                    <div class="pageheader">

                        <h2>Common Elements <span>// You can place subtitle here</span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html"><i class="fa fa-home"></i> ARparts</a>
                                </li>
                                <li>
                                    <a href="#">Form Stuff</a>
                                </li>
                                <li>
                                    <a href="form-common.html">Common Elements</a>
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

                                    <form method='POST' action='{{ action('ParserController@DromParser') }}' class="form-horizontal" role="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">DROM.ru</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input name="html" type="text" class="form-control">
													<span class="input-group-btn">
														<button class="btn btn-default" type="submit">Начать</button>
													</span>
                                                </div>

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

