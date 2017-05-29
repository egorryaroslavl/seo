<?php


	namespace Egorryaroslavl\Seo\Models;

	use Illuminate\Database\Eloquent\Model;


	class SeoModel extends Model
	{
		protected $table = 'seo';
		protected $fillable = [
			'name',
			'alias',
			'metatag_',
			'metatag_title',
			'metatag_description',
			'metatag_keywords',
			'seotext',
		];


	}