<?php namespace Gistlog\Http\Controllers;

use Gistlog\Exceptions\GistNotFoundException;
use Gistlog\Gists\GistClient;
use Gistlog\Gists\GistlogRepository;
use Gistlog\Http\Requests;
use Gistlog\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class GistsController extends Controller
{
    private $repository;

    public function __construct(GistlogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function storeAndRedirect()
    {
        $gistUrl = Input::get('gistUrl');

        try {
            $gistlog = $this->repository->findByUrl($gistUrl);
        } catch (InvalidUrlException $e) {
            Session::flash('error-message', 'Please enter a valid Gist URL.');
            return Redirect::route('home');
        } catch (GistNotFoundException $e) {
            Session::flash('error-message', 'Please enter a valid Gist URL.');
            return Redirect::route('home');
        }

        return Redirect::route('gists.show', [
            'userName' => $gistlog->author,
            'gistId' => $gistlog->id
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
            ->with('pageTitle', $gistlog->title . ' | ' . $gistlog->author);
    }

    public function postComment(Request $request, GistClient $client, $gistId)
    {
        $this->validate($request, ['comment' => 'required']);
        $client->postGistComment($gistId, Input::get('comment'));
        return redirect()->back();
    }
}
