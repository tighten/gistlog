<?php

namespace App\Http\Controllers;

use App\ContentParser\ContentParserFacade;
use App\Gists\GistClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GistCommentsController extends Controller
{
    /**
     * @var GistClient
     */
    private $gistClient;

    public function __construct(GistClient $gistClient)
    {
        $this->gistClient = $gistClient;
    }

    public function jsonIndex($username, $gistId)
    {
        $comments = Cache::remember("GistCommentsWithHtml::{$gistId}", 1800, function () use ($gistId) {
            return collect($this->gistClient->getGistComments($gistId))->map(function ($comment) {
                $comment['body_html'] = ContentParserFacade::transform($comment['body']);

                return $comment;
            })->all();
        });

        return response()->json($comments);
    }

    public function store(Request $request, GistClient $client, $gistId)
    {
        $this->validate($request, ['comment' => 'required']);
        $client->postGistComment($gistId, $request->get('comment'));

        Cache::forget("GistCommentsWithHtml::{$gistId}");

        return redirect()->back();
    }
}
