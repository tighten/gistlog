<?php

namespace App\Http\Controllers;

use App\Authors\AuthorRepository;
use App\User;
use Illuminate\Support\Facades\View;

class AuthorsController extends Controller
{
    /**
     * @var AuthorRepository
     */
    private $repository;

    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show($username)
    {
        $author = $this->repository->findByUsername($username);

        if ($author->gists->isEmpty()) {
            return redirect("https://github.com/{$username}");
        }

        return View::make('authors.show')
            ->with('author', $author)
            ->with('user', User::where('github_id', $author->id)->first())
            ->with('pageTitle', "{$author->name} (@{$author->username})");
    }
}
