<?php

namespace Gistlog\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function edit()
    {
        return view('authors.edit')->with('user', auth()->user());
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'homepage' => 'max:100|url',
            'twitter_username' => 'max:15',
            'google_analytics_id' => 'max:20',
        ]);

        auth()->user()->update($request->only(['homepage', 'twitter_username', 'google_analytics_id']));

        $request->session()->flash('success-message', 'User Settings have been updated.');

        return redirect()->route('users.update');
    }
}
