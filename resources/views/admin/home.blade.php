@extends('layouts.app')

@section('content')
<section id="content">

                <div class="page page-dashboard">

                    <div class="pageheader">

                        <h2>ARparser <span> </span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html"><i class="fa fa-home"></i> ARparser</a>
                                </li>
                                <li>
                                    <a href="index.html">Панель управления</a>
                                </li>
                            </ul>

                            <div class="page-toolbar">
                                <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                                </a>
                            </div>

                        </div>

                    </div>

                    <!-- cards row -->
                    <div class="row">

                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-greensea">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-4">
                                            <i class="fa fa-gear fa-4x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0">{{ $amount_of_parts }}</p>
                                            <span>Запчастей</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <div class="back bg-greensea">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-12">
                                            <a href="{{ route('parts.table') }}"><i class="fa fa-ellipsis-h fa-2x"></i> Перейти</a>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                            </div>
                        </div>
                        <!-- /col -->

                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-lightred">

                                    <!-- row -->
                                    <div class="row">

                                        <!-- col -->
                                        <div class="col-xs-4">
                                            <i class="fa fa-car fa-4x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0">{{ $amount_of_cars }}</p>
                                            <span>Автомобилей</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <div class="back bg-lightred">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-12">
                                            <a href="{{ route('cars.table') }}"><i class="fa fa-ellipsis-h fa-2x"></i> Перейти</a>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                            </div>
                        </div>
                        <!-- /col -->

                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-blue">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-4">
                                            <i class="fa fa-users fa-4x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0">{{ $amount_of_users }}</p>
                                            <span>Сотрудников</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <div class="back bg-blue">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-12">
                                            <a href="#"><i class="fa fa-ellipsis-h fa-2x"></i> Перейти</a>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                            </div>
                        </div>
                        <!-- /col -->

                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-slategray">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-4">
                                            <i class="fa fa-pencil fa-4x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0">1</p>
                                            <span>Парсер</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <div class="back bg-slategray">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-12">
                                            <a href="{{ route('parser.drom') }}"><i class="fa fa-ellipsis-h fa-2x"></i> Перейти</a>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                            </div>
                        </div>
                        <!-- /col -->

                    </div>
                    <!-- /row -->




                    	<!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-12">


                                <!-- tile -->
                                <section class="tile">

                                    <!-- tile header -->
                                    <div class="tile-header dvd dvd-btm">
                                        <h1 class="custom-font"><a href="{{ route('parts.table') }}"><strong>Запчасти</strong></a></h1>
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





                    <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-md-12">


                                <!-- tile -->
                                <section class="tile">

                                    <!-- tile header -->
                                    <div class="tile-header dvd dvd-btm">
                                        <h1 class="custom-font"><strong>Автомобили</strong></h1>
                                        <ul class="controls">
                                            <li><a href="javascipt:;"><i class="fa fa-plus mr-5"></i> Новый автомобиль</a></li>

                                            <li class="dropdown">

                                                <a role="button" tabindex="0" class="dropdown-toggle" data-toggle="dropdown">Инструменты <i class="fa fa-angle-down ml-5"></i></a>
												<!--
                                                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                                    <li>
                                                        <a href="{{ route('xml') }}">Экспортировать в XML</a>
                                                    </li>
                                                    
                                                    <li role="presentation" class="divider"></li>
                                                    <li>
                                                        <a href>Печать счетов-фактур</a>
                                                    </li>

                                                </ul>-->

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
                                                    <th>Название</th>
                                                    <th>Транскрипция</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                	 @foreach ($cars as $car)
														<tr>
														  <td>{{ $car->title }}</td>
														  <td>{{ $car->translate }}</td>
														  <td><a href="{{ route('car.page', [$car->id]) }}" class="btn btn-default btn-xs">ИЗМЕНИТЬ</a></td>
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

                
            </section>
@endsection
