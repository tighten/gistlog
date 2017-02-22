@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <h1>Edit User Settings</h1>

                <div class="bg-info" style="padding: 1em;">
                    <form method="post" action="/user/settings">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ old('homepage') ? 'has-error' : '' }}">
                                        <label for="homepage" class="form-label">Homepage URL:</label>
                                        <input class="form-control" id="homepage" name="homepage" placeholder="http://mysite.com"
                                               value="{{ is_null(old('homepage')) ? $user->homepage : old('homepage') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="twitter_username" class="form-label">Twitter Handle:</label>
                                        <input class="form-control" id="twitter_username" name="twitter_username" placeholder="@myhandle"
                                               value="{{ is_null(old('twitter_username')) ? $user->twitter_username : old('twitter_username') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="google_analaytics_id" class="form-label">Google Analytics ID:</label>
                                        <input class="form-control" id="google_analaytics_id" name="google_analaytics_id" placeholder="UA-XXXXXXXX-X"
                                               value="{{ is_null(old('google_analytics_id')) ? $user->google_analytics_id : old('google_analytics_id') }}">
                                    </div>

                                    <hr style="border-color: #a7d5ec">
                                    <button type="submit" class="btn btn-default">Update Settings</button>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
