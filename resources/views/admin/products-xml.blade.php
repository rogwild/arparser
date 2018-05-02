<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<ADS>
@foreach ($products as $product)
	<Ad>
		<!-- НАЧАЛО В идентификатор (следующая страница) -->
		<Id>{{ $product->id }}</Id>
		<!-- КОНЕЦ В идентификатор -->
		
		<Description>
		
		<!-- НАЧАЛО В название -->
		<h3>{{ $product->name }}</h3>
		<!-- КОНЕЦ В название -->
		
		<!-- НАЧАЛО В описание -->
		<p>
			{{ $product->description }}
		</p>
		<!-- КОНЕЦ В описание -->
		
		<!-- НАЧАЛО В мета-теги -->
		<models>
			@php
				$models = $product->models;
				if ($models != NULL) {
					$models = explode(',', $models);
					$translations = array();
					foreach ($models as $model) {
						$model = trim($model);
						$car = DB::table('cars')->where('alias', $model)->first();
						$translation = $car->title;
						array_push ($translations, $translation);
					}
					array_splice($translations, 5);
				}
				else {
					$translations = array();
				}
			@endphp

			@foreach ($translations as $translation)
				{{ $translation }},
			@endforeach
		</models>
		<engines>
			{{ $product->meta }}
		</engines>
		<!-- КОНЕЦ В мета-теги -->
		
		</Description>
		<product_row>
				[vc_row background_color="#f8f8f8"]
					[vc_column width="1/6" css=".vc_custom_1466572147639{padding-right: 50px !important;padding-left: 30px !important;}"]
					[/vc_column]

						[vc_column width="2/3" css=".vc_custom_1466572981768{padding-right: 50px !important;padding-left: 50px !important;}"]
								[vc_empty_space height="50"]
								[textbox title="{{ $product->name }}" title_color="#262626" title_fontsize="24" text_under_align="center" text_content="{{ $product->description }}" content_align="center" content_fontsize="13" text_content_color="#707070"]
								[vc_empty_space height="35"]
								[vc_row_inner]
									[vc_column_inner width="1/2"]
										[iconbox_top_noborder title="ПРИМЕНИМОСТЬ" title_color="#292929" content_text="
											@foreach ($translations as $translation)
												{{ $translation }},
											@endforeach
										" content_color="#898989" icon="cog" alignment="center_alignment" icon_color="#f83333"]
									[/vc_column_inner]
									[vc_column_inner width="1/2"]
										[iconbox_top_noborder title="КАТЕГОРИЯ" title_color="#292929" content_text="
											@php
												if ($product->category_id != NULL) {
													$category = DB::table('categories')->where('id', $product->category_id)->first();
													$nameOfCategory = $category->name;
													if ($category->parent_id != 0) {
														$parentCategory = DB::table('categories')->where('id', $category->parent_id)->first();
														$nameOfParentCategory = $parentCategory->name;
														echo $nameOfParentCategory.' ';
														echo $nameOfCategory.' ';
													}
													else {
														$nameOfParentCategory = $nameOfCategory;
														echo $nameOfCategory.' ';
													}
												}
												else {
													$nameOfParentCategory = '';
													$nameOfCategory = '';
													echo $nameOfParentCategory.' ';
													echo $nameOfCategory.' ';
												}
											@endphp
										" content_color="#898989" icon="wrench" alignment="center_alignment" icon_color="#f83333"]
									[/vc_column_inner]
								[/vc_row_inner]
								[vc_empty_space height="90"]
							[/vc_column]
					[vc_column width="1/6"]
					[/vc_column]
				[/vc_row]
		</product_row>
		@php
			if ($product->category_id != NULL) {
				$category = DB::table('categories')->where('id', $product->category_id)->first();
				$nameOfCategory = $category->name;
				if ($category->parent_id != 0) {
					$parentCategory = DB::table('categories')->where('id', $category->parent_id)->first();
					$nameOfParentCategory = $parentCategory->name;
					echo "<parentcategory>$nameOfParentCategory</parentcategory><br/>";
					echo "<category>$nameOfCategory</category>";
				}
				else {
					$nameOfParentCategory = $nameOfCategory;
					echo "<category>$nameOfCategory</category>";
				}
			}
			else {
				$nameOfParentCategory = '';
				$nameOfCategory = '';
				echo "<parentcategory>$nameOfParentCategory</parentcategory>";
				echo "<category>$nameOfCategory</category>";
			}
		@endphp
		
		<!-- НАЧАЛО В цену -->
		<Price>{{ $product->price }}</Price>
		<!-- КОНЕЦ В цену -->
		
		<!-- НАЧАЛО В картинку -->
		<Image>
			{{ $product->image }}
		</Image>
		<!-- КОНЕЦ В картинку -->
		
	</Ad>
@endforeach
</ADS>