@extends ('layouts.task')

@section ('content')
	
	<div class="col-sm-12 blog-main">
		<h1>Publier un post</h1>
		<hr>
		<form method="post" action="/posts">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="title">Titre :</label>
				<input type="text" name="title" id="title" class="form-control" aria-describedby="Entrez le titre">
				{{--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>  --}}
			</div>
			<div class="form-group">
				<label for="body">Texte :</label>
				<textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea>
			</div>
			{{--  <label>
				<input type="file" id="file">
			</label>
			<div class="form-check">
				<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Check me out</span>
				</label>
			</div>  --}}
			<button type="submit" class="btn btn-primary">Publier</button>
		</form>
	</div>

@endsection