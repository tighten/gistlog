<?php namespace Gistlog\Http\Controllers;

use Gistlog\Authors\AuthorRepository;
use Illuminate\Support\Facades\View;

class AuthorsController extends Controller
{
	private $repository;

	public function __construct(AuthorRepository $repository)
	{
		$this->repository = $repository;
	}

	public function show($username)
	{
		$author = $this->repository->findByUsername($username);

		return View::make('authors.show')
			->with('author', $author)
			->with('pageTitle', $author->name);
	}
}
