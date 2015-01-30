@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Create a Gistlog</div>

				<div class="panel-body">
					<form method="post" action="/posts/create" class="form-inline">
						<div class="form-group">
							<label for="gistUrl">Paste the URL to a Gist here to create a Gistlog:</label><br>
							<input class="form-control" id="gistUrl" name="gistUrl" placeholder="Enter Gist URL">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
