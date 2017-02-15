<?php

namespace Gistlog\Http\Controllers;

use Illuminate\Http\Request;

use Gistlog\Http\Requests;
use Gistlog\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        $user = auth()->user();
        // show view
        return response('build user form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'homepage' => 'max:100|url',
            'twitter_username' => 'max:15',
            'google_analaytics_id' => 'max:20',
        ]);

        auth()->user()->update(request(['homepage', 'twitter_username', 'google_analytics_id']));

        $request->session()->flash('status', 'User Settings have been updated.');

        return redirect()->route('users.update');
    }
}
