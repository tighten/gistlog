@extends('layouts.app')

@section('content')
<div class="gistlog__container container pt-12">
    <div class="gistlog py-8 sm:px-8">
        <article class="my-8 px-4 sm:px-8 my-8">
            <h1 class="gistlog__title">Edit User Settings</h1>

            <form method="POST" action="/user/settings" class="gistlog__content">
                @csrf

                <label class="flex items-center mb-2">
                    <span>Homepage URL:</span>
                    <input class="py-px px-2 ml-2 text-base border border-grey-light" name="homepage" placeholder="https://mysite.com" value="{{ old('homepage', $user->homepage) }}"/>
                </label>
                @error('homepage')
                    <div class="text-sm text-red mb-2">{{ $message }}</div>
                @enderror

                <label class="flex items-center mb-2">
                    <span>Twitter Handle:</span>
                    <input class="py-px px-2 ml-2 text-base border border-grey-light" name="twitter_username" placeholder="myhandle" value="{{ old('twitter_username', $user->twitter_username) }}">
                </label>
                @error('twitter_username')
                    <div class="text-sm text-red mb-2">{{ $message }}</div>
                @enderror

                <label class="flex items-center mb-2">
                    <span>Google Analytics ID:</span>
                    <input class="py-px px-2 ml-2 text-base border border-grey-light" name="google_analytics_id" placeholder="UA-XXXXXXXX-X" value="{{ old('google_analytics_id', $user->google_analytics_id) }}">
                </label>
                @error('google_analytics_id')
                    <div class="text-sm text-red mb-2">{{ $message }}</div>
                @enderror

                <button type="submit" class="bg-blue text-sm text-white py-2 px-6 rounded my-4">
                    Update Settings
                </button>
            </form>
        </article>
    </div>
</div>
@endsection
