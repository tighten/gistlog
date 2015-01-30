<?php  namespace Gistlog\Gists;

use Guzzle\Http\Client;
use Illuminate\Support\Collection;

class GistCommentRepository
{
    /**
     * @var Client
     */
    private $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * @param Gist $gist
     * @return Collection
     */
    public function getForGist(Gist $gist)
    {
        $response = $this->guzzle->get($gist->comments_url)->send();

        return new Collection(
            json_decode(
                $response->getBody()
            )
        );
    }
}
