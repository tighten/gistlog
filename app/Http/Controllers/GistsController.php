<?php

namespace App\Http\Controllers;

use Throwable;
use App\Gists\GistClient;
use Illuminate\Http\Request;
use App\Gists\GistlogRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            'username' => $gistlog->author,
            'gistId' => $gistlog->id,
        ]);
    }

    public function show($username, $gistId, GistClient $gistClient)
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
            ->with('isStarredForUser', $gistClient->isStarredForUser($gistId));
    }

    protected function star(GistClient $client, $gistId)
    {
        try {
            $client->starGist($gistId);

            return response()->json([
                'success' => true,
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
            ], 500);
        }
    }

    protected function unstar(GistClient $client, $gistId)
    {
        try {
            $client->unstarGist($gistId);

            return response()->json([
                'success' => true,
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
            ], 500);
        }
    }

    public function starCount(GistClient $client, $gistId)
    {
        if (Auth::guest()) {
            abort(403, 'Unauthorized');
        }

        return $client->starCount($gistId);
    }
}
