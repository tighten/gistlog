@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Create a Gistlog</h1>

                <div class="bg-primary" style="padding: 1em;">
                    <form method="post" action="/posts/create">
                        <div class="form-group">
                            <label for="gistUrl">Paste the URL to a Gist here to create a Gistlog:</label><br>
                            <div class="row">
                                <div class="col-md-7">
                                    <input class="form-control" id="gistUrl" name="gistUrl" placeholder="Enter Gist URL">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-default">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <br><br>

                <div class="bg-info" style="padding: 1em;">
                    <p><strong>Tip:</strong> Try this gist (just copy the URL, paste it above, and hit Create) to see how Gistlog works and also to learn a little bit more about what Gistlog is:</p>
                    <input class="form-control" type="text" value="https://gist.github.com/mattstauffer/1c76d40371b295184845">
                </div>
            </div>
        </div>
    </div>
@endsection
