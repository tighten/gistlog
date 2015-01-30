@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Create a Gistlog</div>

				<div class="panel-body">
					<form method="post" action="/posts/create">
						Paste the URL to a Gist here to create a Gistlog:<br>
						<input name="gistUrl">
						<input type="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
