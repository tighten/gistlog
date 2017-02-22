<?php

namespace Gistlog\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function edit()
    {
        $user = auth()->user();

        return view('authors.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'homepage'             => 'max:100|url',
            'twitter_username'     => 'max:15',
            'google_analaytics_id' => 'max:20',
        ]);

        auth()->user()->update(request()->only(['homepage', 'twitter_username', 'google_analytics_id']));

        $request->session()->flash('success-message', 'User Settings have been updated.');

        return redirect()->route('users.update');
    }
}
