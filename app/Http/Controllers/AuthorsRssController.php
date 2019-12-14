<?php

namespace App\Http\Controllers;

use App\Authors\AuthorRepository;

class AuthorsRssController extends Controller
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

        return response(
            view('authors.feed')->with('author', $author)
            )->header('Content-Type', 'text/xml');
    }
}
