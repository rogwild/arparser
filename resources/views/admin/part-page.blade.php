@extends('layouts.app')

@section('content')
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-shop-single-product">

                    <div class="pageheader">

                        <h2>{{ $title_promo }} <span> {{ $category }} </span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> ARparser</a>
                                </li>
                                <li>
                                    <a href="#">Магазин</a>
                                </li>
                                <li>
                                    <a href="shop-single-product.html">{{ $title_promo }}</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>

                    <div class="pagecontent">



                        <div class="add-nav">
                            <div class="nav-heading">
                                <h3>Номер: <strong class="text-greensea">{{ $part->id }}</strong></h3>
                                <span class="controls pull-right">
                                  <a href="{{ route('parts.table') }}" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Назад"><i class="fa fa-times"></i></a>
                                  <!--
                                  <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-success btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Save"><i class="fa fa-check"></i></a>-->
                                  <a href="{{ route('part.delete',[$part->id]) }}" class="btn btn-ef btn-ef-1 btn-ef-1-danger btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Удалить"><i class="fa fa-trash"></i></a>
                                  <!--
                                  <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="More"><i class="fa fa-ellipsis-h"></i></a>-->
                                </span>
                            </div>

                            <div role="tabpanel">
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Информация</a></li>
                                    <li role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">Основное</a></li>
                                    <li role="presentation"><a href="#avito" aria-controls="avito" role="tab" data-toggle="tab">Для avito</a></li>
                                    <li role="presentation"><a href="#drom" aria-controls="drom" role="tab" data-toggle="tab">Для drom.ru</a></li>
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

                                                                <a href="{{ $part->image }}" class="img-link" data-lightbox="gallery-item">
                                                                    <img src="{{ $part->image }}" alt="" class="img-responsive mb-20">
                                                                </a>

                                                            </div>
                                                            <!-- /col -->

                                                            <!-- col -->
                                                            <div class="col-md-8">

                                                                <h2 class="custom-font mb-5">
																	<a href="{{ $part->link }}">
																		{{ $title_promo }}
																	</a>
																	
																	<!--
																	<span class="label label-success">{{ $category }}</span>
																	-->
                                                                </h2>

                                                                <p class="short-desc text-sm text-default lt mb-5">
                                                                	Обычная цена: {{ $price_main }} рублей
                                                                </p>
                                                                <p class="short-desc text-sm text-default lt mb-5">
                                                                	Номер в каталоге: {{ $number }}
                                                                </p>
                                                                <p class="short-desc text-sm text-default lt mb-20">
                                                                	Ключевые слова:
                                                                	{{ $part->part_description }}
                                                                </p>
                                                                
                                                                <p class="short-desc text-sm text-default lt mb-0">
                                                                	Применимость:
                                                                </p>
                                                                <p class="tags">
																	@foreach ($translations as $translation)
																		<span class="label label-default mr-5">{{ $translation }}</span>
																	@endforeach
                                                                </p>
                                                                <p class="short-desc text-sm text-default lt mb-0">
                                                                	Двигатели: {{ $parsed_engine }}
                                                                </p>
                                                                <h3 class="price mt-40 mb-0 text-success ng-binding">{{ $price }} <small>рублей</small></h3>
                                                                <!--
                                                                <p class="discount text-sm text-default lt">Discount: 8%</p>
                                                                -->
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


                                                        <form method='POST' class="form-horizontal ng-pristine ng-valid" role="form" action='{{ action('ParserController@PartEdit', $part->id) }}' enctype="multipart/form-data">
                                                            {{ csrf_field() }}

                                                            <div class="form-group">
                                                                <label for="id" class="col-sm-2 control-label">ID: </label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="id" placeholder="Item ID" value="{{ $part->id }}" disabled="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="title" class="col-sm-2 control-label">Название: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="title" name="newTitle" placeholder="Item Name" value="{{ $part->titleOfAd }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="image" class="col-sm-2 control-label">Ссылка на картинку: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="image" name="newImage" placeholder="Item Name" value="{{ $part->image }}">
                                                                </div>
                                                            </div>
                                                               
                                                            <div class="form-group">
                                                               <label for="file" class="col-sm-2 control-label">Ссылка на картинку: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input id="file" type="file" name="newFile" multiple>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="category" class="col-sm-2 control-label">Категория: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="category" name="newCategory" placeholder="Item Name" value="{{ $part->category }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="avito_category" class="col-sm-2 control-label">Категория AVITO: <span class="text-lightred text-md"></span></label>
                                                                <div class="col-sm-10">
                                                                    <select tabindex="5" id="avito_category" class="chosen-select" style="width: 100%;" name="newAvito_category">
                                                                       <option value="{{ $part->avito_category }}">
																			Нынешнее значение | {{ $part->avito_category }}
																		</option>
                                                                        <option value="11-618">11-618 Автосвет</option>
																		<option value="11-619">11-619 Аккумуляторы</option>
																		<option value="11-621">11-621 Запчасти для ТО</option>
																		<option value="11-623">11-623 Подвеска</option>
																		<option value="11-624">11-624 Рулевое управление</option>
																		<option value="11-625">11-625 Салон</option>
																		<option value="16-521">16-521 Система охлаждения</option>
																		<option value="11-626">11-626 Стекла</option>
																		<option value="11-627">11-627 Топливная и выхлопная системы</option>
																		<option value="11-628">11-628 Тормозная система</option>
																		<option value="11-629">11-629 Трансмиссия и привод</option>
																		<option value="11-630">11-630 Электрооборудование</option>
																		<option value="16-827">16-827 Двигатель / Блок цилиндров, головка, картер</option>
																		<option value="16-828">16-828 Двигатель / Вакуумная система</option>
																		<option value="16-829">16-829 Двигатель / Генераторы, стартеры</option>
																		<option value="16-830">16-830 Двигатель / Двигатель в сборе</option>
																		<option value="16-831">16-831 Двигатель / Катушка зажигания, свечи, электрика</option>
																		<option value="16-832">16-832 Двигатель / Клапанная крышка</option>
																		<option value="16-833">16-833 Двигатель / Коленвал, маховик</option>
																		<option value="16-834">16-834 Двигатель / Коллекторы</option>
																		<option value="16-835">16-835 Двигатель / Крепление двигателя</option>
																		<option value="16-836">16-836 Двигатель / Масляный насос, система смазки</option>
																		<option value="16-837">16-837 Двигатель / Патрубки вентиляции</option>
																		<option value="16-838">16-838 Двигатель / Поршни, шатуны, кольца</option>
																		<option value="16-839">16-839 Двигатель / Приводные ремни, натяжители</option>
																		<option value="16-840">16-840 Двигатель / Прокладки и ремкомплекты</option>
																		<option value="16-841">16-841 Двигатель / Ремни, цепи, элементы ГРМ</option>
																		<option value="16-842">16-842 Двигатель / Турбины, компрессоры</option>
																		<option value="16-843">16-843 Двигатель / Электродвигатели и компоненты</option>
																		<option value="16-805">16-805 Кузов / Балки, лонжероны</option>
																		<option value="16-806">16-806 Кузов / Бамперы</option>
																		<option value="16-807">16-807 Кузов / Брызговики</option>
																		<option value="16-808">16-808 Кузов / Двери</option>
																		<option value="16-809">16-809 Кузов / Заглушки</option>
																		<option value="16-810">16-810 Кузов / Замки</option>
																		<option value="16-811">16-811 Кузов / Защита</option>
																		<option value="16-812">16-812 Кузов / Зеркала</option>
																		<option value="16-813">16-813 Кузов / Кабина</option>
																		<option value="16-814">16-814 Кузов / Капот</option>
																		<option value="16-815">16-815 Кузов / Крепления</option>
																		<option value="16-816">16-816 Кузов / Крылья</option>
																		<option value="16-817">16-817 Кузов / Крыша</option>
																		<option value="16-818">16-818 Кузов / Крышка, дверь багажника</option>
																		<option value="16-819">16-819 Кузов / Кузов по частям</option>
																		<option value="16-820">16-820 Кузов / Кузов целиком</option>
																		<option value="16-821">16-821 Кузов / Лючок бензобака</option>
																		<option value="16-822">16-822 Кузов / Молдинги, накладки</option>
																		<option value="16-823">16-823 Кузов / Пороги</option>
																		<option value="16-824">16-824 Кузов / Рама</option>
																		<option value="16-825">16-825 Кузов / Решетка радиатора</option>
																		<option value="16-826">16-826 Кузов / Стойка кузова</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <!--
                                                            <div class="form-group">
                                                                <label for="description" class="col-sm-2 control-label">Дополнительное описание: <span class="text-lightred text-md">
                                                                	@if ($part->description == 1)
																		ГРМ
																	@elseif ($part->description == 2)
																		Прокладки ДВС
																	@elseif ($part->description == 3)
																		Стойки
																	@endif 
                                                                </span></label>
                                                                <div class="col-sm-10">
                                                                    <select tabindex="3" id="description" class="chosen-select" name="newDescription" style="width: 100%;">
                                                                        <option value="0"></option>
																		<option value="1">ГРМ</option>
																		<option value="2">Прокладки ДВС</option>
																		<option value="3">Стойки</option>
																		<option value="">пусто</option>
                                                                    </select>
                                                                </div>
                                                            </div>-->
                                                            
                                                            <div class="form-group">
                                                                <label for="part_description" class="col-sm-2 control-label">Ключевые слова: <span class="text-lightred text-md">
                                                                </span></label>
                                                                <div class="col-sm-10">
                                                                    <select tabindex="3" id="part_description" class="chosen-select" name="newPart_description" style="width: 100%;">
                                                                       		<option value="{{ $part->part_description }}">
																				Нынешнее значение | {{ $part->part_description }}
																			</option>
                                                                        @foreach ($keywords as $keyword)
																			<option value="{{ $keyword->words }}">
																				{{ $keyword->name }} | {{ $keyword->words }}
																			</option>
																		@endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <!--
                                                            <div class="form-group">
                                                                <label for="main_description" class="col-sm-2 control-label">Основное описание: <span class="text-lightred text-md"></span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="main_description" name="newMain_description" placeholder="Основное описание" value="{{ $part->main_description }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="part_description" class="col-sm-2 control-label">Дополнительное описание (ручное): <span class="text-lightred text-md"></span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="part_description" name="newPart_description" placeholder="Амортизатор, амортик, стойка..." value="{{ $part->part_description }}">
                                                                </div>
                                                            </div>-->
                                                            
                                                            <div class="form-group">
                                                                <label for="parsed_engine" class="col-sm-2 control-label">Двигатели: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="parsed_engine" name="newPrice" placeholder="Item Name" value="{{ $part->parsed_engine }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="number" class="col-sm-2 control-label">Номер: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="number" name="newNumber" placeholder="Item Name" value="{{ $part->number }}">
                                                                </div>
                                                            </div>

                                                           <!-- 
														   <div class="form-group">
                                                                <label for="description" class="col-sm-2 control-label">Description: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                <textarea class="form-control" id="description" placeholder="Item Description" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                                                </textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="sdescription" class="col-sm-2 control-label">Short Description: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                <textarea class="form-control" id="sdescription" placeholder="Short Item Description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                </textarea>
                                                                    <span class="help-block">as show in product listing</span>
                                                                </div>
                                                            </div>-->

                                                           <!-- 
														   <div class="form-group">
                                                                <label for="category" class="col-sm-2 control-label">Category: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <select tabindex="3" id="category" multiple="" class="chosen-select" style="width: 100%;">
                                                                        <optgroup label="Food">
                                                                            <option value="Vegetables">Vegetables</option>
                                                                            <option value="Fruits">Fruits</option>
                                                                            <option value="Meat">Meat</option>
                                                                            <option value="Frozen">Frozen</option>
                                                                        </optgroup>
                                                                        <optgroup label="Beverages">
                                                                            <option value="Limo">Limo</option>
                                                                            <option value="Alco">Alco</option>
                                                                            <option value="Beer">Beer</option>
                                                                        </optgroup>
                                                                        <optgroup label="Electro">
                                                                            <option value="TV">TV</option>
                                                                            <option value="Hi-FI">Hi-FI</option>
                                                                            <option value="Audio">Audio</option>
                                                                            <option value="Video">Video</option>
                                                                            <option value="Computers">Computers</option>
                                                                        </optgroup>
                                                                        <optgroup label="Kitchen">
                                                                            <option value="Microwaves">Microwaves</option>
                                                                            <option value="Accesories">Accesories</option>
                                                                            <option value="Bowls">Bowls</option>
                                                                            <option value="Knifes">Knifes</option>
                                                                        </optgroup>
                                                                        <optgroup label="Bathroom">
                                                                            <option value="Sponges">Sponges</option>
                                                                            <option value="Showers">Showers</option>
                                                                            <option value="Soaps">Soaps</option>
                                                                            <option value="Towels">Towels</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                            </div>-->

                                                            <div class="form-group">
                                                                <label for="price" class="col-sm-2 control-label">Цена: <span class="text-lightred text-md">{{ $part->price_main }}</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" value="{{ $part->price }}" id="price" class="form-control touchspin" data-min='0' data-max="100000" data-step="0.1" data-decimals="0" name="newPrice" data-stepinterval="50" data-maxboostedstep="100000" data-prefix="Рублей">
                                                                </div>
                                                            </div>

                                                           <!-- 
														   <div class="form-group">
                                                                <label for="discount" class="col-sm-2 control-label">Discount: <span class="text-lightred text-md">*</span></label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" value="8" id="discount" class="form-control touchspin" data-min='0' data-max="100" data-boostat="5" data-maxboostedstep="10" data-postfix="%">
                                                                </div>
                                                            </div>
                                                            -->
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
                                    <div role="tabpanel" class="tab-pane" id="avito">



                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12">


                                                <!-- tile -->
                                                <section class="tile">

                                                    <!-- tile header -->
                                                    <div class="tile-header dvd dvd-btm">
                                                        <h1 class="custom-font"><strong>Информация </strong> для avito.ru</h1>
                                                    </div>
                                                    <!-- /tile header -->


                                                    <!-- tile body -->
                                                    <div class="tile-body">
                                                    	
                                                    	<div class="row">
                                                    		<div class="col-xs-12">
                                                    			<img src="{{ $image }}" alt="" class="img-responsive">
																<h4>Категория: {{ $category }}</h4>
																<h2 class="display-4">{{ $titleOfAd }}</h2>
																<br>
																<h3>Цена: {{ $price }} рублей</h3>
																<br>
																<p>
																	  <strong>{{ $part->additional_description_3 }}</strong><br><br>

																		<strong>В продаже:</strong><br>

																		<i> {{ $part->main_description }} </i><br>
																		
																		@if ($part->part_description !== NULL)
																			{{ $part->part_description }}
																			<br/>
																		@endif



																		 <strong>Применимость:</strong><br>
																			<ul>
																				@foreach ($translations as $translation)
																					<li>{{ $translation }}</li>
																				@endforeach
																			</ul>


																		<strong>Для двигателей:</strong>

																		{{ $parsed_engine }}<br>



																		<strong><i> {{ $part->additional_description_1 }} </i><br>

																		{{ $part->additional_description_2 }}</strong>
																</p>
                                                    		</div>
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
                                    <div role="tabpanel" class="tab-pane" id="drom">



                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12">


                                                <!-- tile -->
                                                <section class="tile">

                                                    <!-- tile header -->
                                                    <div class="tile-header dvd dvd-btm">
                                                        <h1 class="custom-font"><strong>Информация </strong> для drom.ru</h1>
                                                    </div>
                                                    <!-- /tile header -->


                                                    <!-- tile body -->
                                                    <div class="tile-body">
                                                    	
                                                    	<div class="row">
                                                    		<div class="col-xs-12">
                                                    			<h6>{{ $link }}</h6>
																<img src="{{ $image }}" alt="" class="img-responsive">
																<h4>Категория: {{ $category }}</h4>
																<h2 class="display-4">{{ $titleOfAd }}</h2>
																<br>
																<p>Обычная цена: {{ $price_main }} рублей</p>
																<h3>Наша цена: {{ $price }} рублей</h3>
																<br>
																<h3>Номер в каталоге: {{ $number }}</h3>
																<br>
																<h3>Применимость:</h3>
																<ul>
																	@foreach ($translations as $translation)
																		<li>{{ $translation }}</li>
																	@endforeach
																</ul>
																<br>
																<p>
																	  Если Вы не уверены подойдет ли данная деталь на Ваш автомобиль, ЗВОНИТЕ, наши специалисты помогут подобрать именно то, что Вам необходимо! <br><br>

																	  Качественная установка купленных запчастей в нашем АВТОСЕРВИСЕ с 15% скидкой! Подробности уточняйте у наших менеджеров по телефонам!<br><br>

																	  Уточнить совместимость детали и наличие на складе Вы можете нажав кнопку ЗАДАТЬ ВОПРОС!
																</p>
                                                    		</div>
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

