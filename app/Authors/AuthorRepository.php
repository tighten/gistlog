<?php  namespace Gistlog\Authors;

class AuthorRepository
{
    /**
     * @var AuthorClient
     */
    private $authorClient;

    public function __construct(AuthorClient $authorClient)
    {
        $this->authorClient = $authorClient;
    }

    /**
     * @param $username
     * @return Author
     */
    public function findByUsername($username)
    {
        $author = $this->authorClient->getAuthor($username);
        $gists = $this->authorClient->getAuthorPublishableGists($username);

        return Author::fromGitHub($author, $gists);
    }
}
