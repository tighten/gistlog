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
	private $repository;

	public function __construct(GistRepository $repository)
	{
		$this->repository = $repository;
	}

	public function storeAndRedirect()
	{
		$gistUrl = Input::get('gistUrl');

		try {
			$gist = $this->repository->findByUrl($gistUrl);
		} catch (InvalidUrlException $e) {
			dd('that url is bad yo');
		} catch (GistNotFoundException $e) {
			dd('could not find that gist yo');
		}

		return Redirect::route('gists.show', [
			'userName' => $gist->author,
			'gistId' => $gist->id
		]);
	}

	public function show($userName, $gistId)
	{
		$gist = $this->repository->findById($gistId);

		if ($userName !== $gist->author) {
			dd('bad url dummy');
		}

		return View::make('gistlogs.show')->with('gist', $gist);
	}
}
