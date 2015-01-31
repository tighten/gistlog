<?php namespace Gistlog\Http\Controllers;

use Carbon\Carbon;
use Gistlog\Gists\FilePresenter;
use Gistlog\Gists\GistCommentRepository;
use Gistlog\Gists\GistRepository;
use Gistlog\Http\Requests;
use Gistlog\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class GistsController extends Controller
{
	public function storeAndRedirect(GistRepository $repository)
	{
		$gistUrl = Input::get('gistUrl');

		try {
			$gist = $repository->getByURL($gistUrl);
		} catch (InvalidUrlException $e) {
			dd('that url is bad yo');
		} catch (GistNotFoundException $e) {
			dd('could not find that gist yo');
		}

		return Redirect::to("{$gist->userName}/{$gist->id}");
	}

	public function show($userName, $gistId, GistRepository $gistRepository, GistCommentRepository $commentRepository)
	{
		$gist = $gistRepository->findById($gistId);

		if ($userName !== $gist->author) {
			dd('bad url dummy');
		}

		return View::make('gistlogs.show')->with('gist', $gist);
	}
}
