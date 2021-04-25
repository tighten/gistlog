<?php

namespace App\Http\Controllers;

use App\Authors\AuthorRepository;
use Exception;
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
        try {
            $author = $this->repository->findByUsername($username);
        } catch (Exception $e) {
            abort(404);
        }

        if ($author->gists->isEmpty()) {
            return redirect("https://github.com/{$username}");
        }

        return View::make('authors.show')
            ->with('author', $author)
            ->with('pageTitle', "{$author->name} (@{$author->username})");
    }
}
