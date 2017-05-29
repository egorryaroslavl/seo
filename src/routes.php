<?php



	/*=============  SEO  ==============*/

	Route::group(['middleware'=>'web'], function(  ){

		Route::get( '/admin/seo', 'egorryaroslavl\seo\SeoController@index' );
		Route::get( '/admin/seo/create', 'egorryaroslavl\seo\SeoController@create' )->middleware( 'web' );
		Route::get( '/admin/seo/{id}/edit', 'egorryaroslavl\seo\SeoController@edit' )->middleware( 'web' );
		Route::get( '/admin/seo/{id}/delete', 'egorryaroslavl\seo\SeoController@destroy' )->middleware( 'web' );
		Route::post( '/admin/seo/store', 'egorryaroslavl\seo\SeoController@store' )->middleware( 'web' );

		Route::post( '/admin/seo/update', 'egorryaroslavl\seo\SeoController@update' )->middleware( 'web' );

	});




	/*=============  /SEO  ==============*/

