<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Gists\GistClient;
use Github\Client as GitHubClient;
use Github\Exception\RuntimeException;
use Github\HttpClient\Message\ResponseMediator;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Gists\GistlogRepository;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Exceptions\GistNotFoundException;

class GistsController extends Controller
{
    private $repository;

    public function __construct(GistlogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function storeAndRedirect(Request $request)
    {
        $gistUrl = $request->get('gistUrl');

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
            ->with('pageTitle', $gistlog->title.' | '.$gistlog->author)
            ->with('isStarredForUser', $this->isStarredForUser($gistId));
    }

    public function star(GistClient $client, $gistId)
    {
        $client->starGist($gistId);
    }

    public function unstar(GistClient $client, $gistId)
    {
        $client->unstarGist($gistId);
    }

    public function isStarredForUser($gistId)
    {
        try {
            Auth::check();
            $gistClient = app(GistClient::class);
            $gistClient->github->authenticate(Auth::user()->token, GitHubClient::AUTH_HTTP_TOKEN);
            $gistClient->github->getHttpClient()->get("https://api.github.com/gists/{$gistId}/star");

            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
}

