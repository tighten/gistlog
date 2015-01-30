<?php namespace Gistlog\Http\Controllers;

use Carbon\Carbon;
use Gistlog\Gists\FilePresenter;
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

	public function show($userName, $gistId, GistRepository $repository)
	{
		$gist = $repository->getByUserNameAndId($userName, $gistId);

		$file = reset($gist->files);

		return View::make('gistlogs.show')
			->with('secret', ! $gist->public)
			->with('title', $gist->description)
			->with('link', $gist->html_url)
			->with('createdDate', new Carbon($gist->created_at))
			->with('updatedDate', new Carbon($gist->updated_at))
			->with('commentsCount', $gist->comments)
			->with('commentsUrl', $gist->comments_url)
			->with('userPhotoUrl', $gist->user['avatar_url'])
			->with('userName', $gist->userName)
			->with('content', FilePresenter::present($file));
	}
}
