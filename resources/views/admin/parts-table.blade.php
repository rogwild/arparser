@extends('layouts.app')

@section('content')
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-shop-products">

                    <div class="pageheader">

                        <h2>Запчасти <span> </span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="{!! url('admin/home'); !!}"><i class="fa fa-home"></i> ARparser</a>
                                </li>
                                <li>
                                    <a href="#">Магазин</a>
                                </li>
                                <li>
                                    <a href="shop-products.html">Запчасти</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>

                    <!-- page content -->
                    <div class="pagecontent">


                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-12">


                                <!-- tile -->
                                <section class="tile">

                                    <!-- tile header -->
                                    <div class="tile-header dvd dvd-btm">
                                        <h1 class="custom-font"><strong>Запчасти</strong></h1>
                                        <ul class="controls">
                                            <li><a href="javascipt:;"><i class="fa fa-plus mr-5"></i> Новая запчасть</a></li>

                                            <li class="dropdown">

                                                <a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">Инструменты <i class="fa fa-angle-down ml-5"></i></a>

                                                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                                    <li>
                                                        <a href="{{ route('xml') }}">Экспортировать в XML</a>
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
                                                    <th>id</th>
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
												  <td>{{ $part->description }}</td>
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

                                    </div>
                                    <!-- /tile body -->

                                </section>
                                <!-- /tile -->

                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->




                    </div>
                    <!-- /page content -->

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

                //initialize datatable
                $('#products-list').DataTable({
                    "dom": '<"row"<"col-md-8 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"pull-right"f>>>t<"row"<"col-md-4 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"inline-controls text-center"i>><"col-md-4 col-sm-12"p>>',
                    "language": {
                        "sLengthMenu": 'View _MENU_ records',
                        "sInfo":  'Found _TOTAL_ records',
                        "oPaginate": {
                            "sPage":    "Page ",
                            "sPageOf":  "of",
                            "sNext":  '<i class="fa fa-angle-right"></i>',
                            "sPrevious":  '<i class="fa fa-angle-left"></i>'
                        }
                    },
                    "pagingType": "input",
                    "ajax": 'assets/extras/products.json',
                    "order": [[ 1, "asc" ]],
                    "columns": [
                        {
                            "data": "null",
                            "defaultContent": '<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input type="checkbox" class="selectMe"><i></i></label>'
                        },
                        { "data": "id" },
                        { "data": "name" },
                        { "data": "category" },
                        {
                            "data": "price",
                            "type": "num-fmt",
                            "render": function (data) {
                                return '$' + parseFloat(data).toFixed(2);
                            }
                        },
                        {
                            "data": "date",
                            "className": "formatDate"
                        },
                        {
                            "type": "html",
                            "data": "status",
                            "render": function (data) {
                                if (data === 'published') {
                                    return '<span class="label bg-success">' + data + '</span>'
                                } else if (data === 'not published') {
                                    return '<span class="label bg-warning">' + data + '</span>'
                                } else if (data === 'deleted') {
                                    return '<span class="label bg-lightred">' + data + '</span>'
                                }
                            }
                        },
                        {
                            "data": null,
                            "defaultContent": '<a href="shop-single-product" class="btn btn-xs btn-default mr-5"><i class="fa fa-search"></i> View</a><a href="javascript:;" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>'
                        }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "drawCallback": function(settings, json) {
                        $(".formatDate").each(function (idx, elem) {
                            $(elem).text($.format.date($(elem).text(), "MMM d, yyyy"));
                        });
                        $('#select-all').change(function() {
                            if ($(this).is(":checked")) {
                                $('#products-list tbody .selectMe').prop('checked', true);
                            } else {
                                $('#products-list tbody .selectMe').prop('checked', false);
                            }
                        });
                    }
                });
                //*initialize datatable
            });
        </script>
        <!--/ Page Specific Scripts -->
@endsection

