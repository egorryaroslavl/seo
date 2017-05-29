<?php

	namespace Egorryaroslavl\Seo;

	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Illuminate\Validation\Rule;
	use Egorryaroslavl\Seo\Models\SeoModel;

	class SeoController extends Controller
	{

		protected $messages =
			[
				'name.required'                            => 'Поле "URL - владелец метатегов" обязятельно для заполнения!',
				'alias.required'                           => 'Поле "Псевдоним для URL" обязятельно для заполнения!',
				'name.unique'                              => 'Значение поля "URL - владелец метатегов" не является уникальным!',
				'alias.unique'                             => 'Значение поля "Псевдоним для URL" не является уникальным!',
				'metatag_title.required_without_all'       => 'Должно быть заполнено хотя бы одно поле из полей TITLE, DESCRIPTION, KEYWORDS!',
				'metatag_description.required_without_all' => 'Должно быть заполнено хотя бы одно поле из полей TITLE, DESCRIPTION, KEYWORDS!',
				'metatag_keywords.required_without_all'    => 'Должно быть заполнено хотя бы одно поле из полей TITLE, DESCRIPTION, KEYWORDS!',
			];

		public function index()
		{
			$data        = SeoModel::paginate( 30 );
			$data->table = 'seo';
			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2>Metatags</h2><ol class="breadcrumb"><li><a href="/admin">Главная</a></li><li class="active">Metatags</li></ol></div></div>';		
			return view( 'seo::index', [ 'data' => $data, 'breadcrumbs' => $breadcrumbs  ] );

		}


		public function create()
		{
			$data        = new SeoModel();
			$data->act   = 'store';
			$data->table = 'seo';

			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2>Metatags</h2><ol class="breadcrumb"><li><a href="/admin">Главная</a></li><li class="active"><a href="/admin/seo">Metatags</a></li><li><strong>Создание новой записи</strong></li></ol></div></div>';

			return view( 'seo::form', [ 'data' => $data, 'breadcrumbs' => $breadcrumbs ] );


		}

		public function store( Request $request )
		{

			$v = \Validator::make( $request->all(), [
				'name'                => 'required|unique:seo|max:255',
				'metatag_title'       => 'required_without_all:metatag_description,metatag_keywords',
				'metatag_description' => 'required_without_all:metatag_title,metatag_keywords',
				'metatag_keywords'    => 'required_without_all:metatag_title,metatag_description',


			], $this->messages );


			if( $v->fails() ){
				return redirect( 'admin/seo/create' )
					->withErrors( $v )
					->withInput();
			}

			$input            = $request->all();
			$input[ 'alias' ] = str_slug( $input[ 'name' ] );
			$input            = array_except( $input, '_token' );
			$id               = SeoModel::create( $input );

			if( isset( $request->submit_button_stay ) ){
				return redirect()->back();
			}

			\Session::flash( 'message','Запись добавлена! ID-' . $id->id );

			if( isset( $request->submit_button_stay ) ){
				return redirect()->back();
			}
			return redirect( '/admin/seo' );


		}

		public function edit( $id )
		{
			$data        = SeoModel::where( 'id', $id )->first();
			$data->table = 'seo';
			$data->act   = 'update';
			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2>Metatags</h2><ol class="breadcrumb"><li><a href="/admin">Главная</a></li><li class="active"><a href="/admin/seo">Metatags</a></li><li>Редактирование <strong>[ ' . $data->name . ' ]</strong></li></ol></div></div>';

			return view( 'seo::form', [ 'data' => $data, 'breadcrumbs' => $breadcrumbs ] );
		}


		public function update( Request $request )
		{

			$v = \Validator::make( $request->all(), [
				'name'                => [
					'required',
					Rule::unique( 'seo' )->ignore( $request->id ),
					'max:255'
				],
				'metatag_title'       => 'required_without_all:metatag_description,metatag_keywords',
				'metatag_description' => 'required_without_all:metatag_title,metatag_keywords',
				'metatag_keywords'    => 'required_without_all:metatag_title,metatag_description',

			], $this->messages );


			if( $v->fails() ){
				return redirect( 'admin/seo/' . $request->id . '/edit' )
					->withErrors( $v )
					->withInput();
			}


			$metatag                      = SeoModel::find( $request->id );
			$metatag->name                = $request->name;
			$metatag->alias               = str_slug( $metatag->name );
			$metatag->metatag_title       = $request->metatag_title;
			$metatag->metatag_description = $request->metatag_description;
			$metatag->metatag_keywords    = $request->metatag_keywords;
			$metatag->seotext             = $request->seotext;
			$metatag->save();

			\Session::flash( 'message', "Запись обновлена!" );

			if( isset( $request->submit_button_stay ) ){
				return redirect()->back();
			}
			return redirect( '/admin/seo' );
		}


		public function destroy( $id )
		{

			$seo = SeoModel::find( $id );
			$seo->delete();
			return redirect()->back();

		}


	}