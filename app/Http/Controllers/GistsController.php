<?php

namespace Gistlog\Http\Controllers;

use Gistlog\Http\Requests;
use Illuminate\Http\Request;
use Gistlog\Gists\GistClient;
use Illuminate\Support\Facades\App;
use Gistlog\Gists\GistlogRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Gistlog\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Gistlog\Exceptions\GistNotFoundException;

class GistsController extends Controller
{
    private $repository;

    public function __construct(GistlogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function storeAndRedirect()
    {
        $gistUrl = Request::get('gistUrl');

        try {
            $gistlog = $this->repository->findByUrl($gistUrl);
        } catch (InvalidUrlException $e) {
            Session::flash('error-message', 'Please enter a valid Gist URL.');

            return Redirect::back();
        } catch (GistNotFoundException $e) {
            Session::flash('error-message', 'Please enter a valid Gist URL.');

            return Redirect::back();
        }

        return Redirect::route('gists.show', [
            'userName' => $gistlog->author,
            'gistId' => $gistlog->id,
        ]);
    }

    public function show($username, $gistId)
    {
        try {
            $gistlog = $this->repository->findById($gistId);
        } catch (GistNotFoundException $e) {
            abort(404, 'Gist not found');
        }

        if ($username !== $gistlog->author) {
            return Redirect::route('gists.show', [
                'username' => $gistlog->author,
                'gistId'   => $gistlog->id,
            ]);
        }

        return View::make('gistlogs.show')
            ->with('gistlog', $gistlog)
            ->with('pageTitle', $gistlog->title.' | '.$gistlog->author);
    }

    public function postComment(Request $request, GistClient $client, $gistId)
    {
        $this->validate($request, ['comment' => 'required']);
        $client->postGistComment($gistId, Request::get('comment'));

        return redirect()->back();
    }
}
