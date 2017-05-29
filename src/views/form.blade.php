@extends('admin.layouts.basic')
@section('content')
	@if (\Session::has('message'))
		<div class="alert alert-info" style="font-size:24px">{{ Session::get('message') }}</div>
	@endif
	@if(count($errors)>0)
		<div id="err">
			@foreach($errors->all() as $error)
				<p class="alert alert-danger">{{$error}}</p>
			@endforeach
			<script>
				window.onload = function(){
					document.getElementById( "err" ).focus();
				};
			</script>
		</div>
	@endif
	<form class="form-horizontal" method="post" action="/admin/seo/{{$data->act}}">
		@if(isset( $data->id ) ) <input type="hidden" name="id" value="{{$data->id}}"/>@endif
		<div class="row">
			<div class="col-xs-12">
				<label for="name">URL - владелец метатегов*</label>
				<input
					type="text"
					name="name"
					class="name form-control"
					id="name"
					value="{{$data->name or ''}}"
					placeholder="URL - владелец метатегов">
			</div>
		</div>
		<hr style="height:2px; background:#c4c3f8;">
		<div class="row">
			<div class="col-xs-6">
				<label for="metatag_title">TITLE</label>
				<input
					type="text"
					name="metatag_title"
					class="form-control"
					id="metatag_title"
					value="{{$data->metatag_title or ''}}"
					placeholder="TITLE">
				<label for="metatag_address">DESCRIPTION</label>
				<input
					type="text"
					name="metatag_description"
					class="form-control"
					id="metatag_description"
					value="{{$data->metatag_description or ''}}"
					placeholder="DESCRIPTION">
				<label for="metatag_keywords">KEYWORDS</label>
				<input
					type="text"
					name="metatag_keywords"
					class="form-control"
					id="metatag_keywords"
					value="{{$data->metatag_keywords or ''}}"
					placeholder="KEYWORDS">
			</div>
			<div class="col-xs-6">
				<label for="seotext">SEO текст</label>
				<textarea
					name="seotext"
					class="form-control"
					id="seotext"
					rows="9"
					placeholder="SEO текст">{{$data->seotext or ''}}</textarea>
			</div>
		</div>
		<hr style="height:2px; background:#c4c3f8;">
			{{ csrf_field() }}
		<div class="row">
			<div class="col-xs-5 col-xs-push-1">
				<input
					type="submit"
					class="btn btn-primary btn-block"
					name="submit_button_back"
					value="ГОТОВО и к списку">
			</div>
			<div class="col-xs-5 col-xs-pull-0">
				<input
					type="submit"
					class="btn btn-info btn-block"
					name="submit_button_stay"
					value="ГОТОВО и остаться">
			</div>
		</div>
		<hr>
	</form>
@endsection