<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateSeoTable extends Migration
	{

		public function up()
		{
			Schema::create( 'seo', function ( Blueprint $table ){
				$table->increments( 'id' );
				$table->string( 'name' );
				$table->string( 'alias' );
				$table->string( 'metatag_title' )->nullable();
				$table->string( 'metatag_description' )->nullable();
				$table->string( 'metatag_keywords' )->nullable();
				$table->text( 'seotext' )->nullable();
				$table->timestamps();
			} );
		}


		public function down()
		{
			Schema::drop( 'seo' );
		}
	}
