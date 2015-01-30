<?php  namespace Gistlog\Gists;

class Gist
{
    public $id;
    public $userName;

    public function __construct()
    {

    }

    public static function fromGithub($id, array $gist)
    {
        // OMG THE BAD PRACTICES
        $self = new self;

        foreach ($gist as $key => $value) {
            $self->$key = $value;
        }

        $self->id = $id;
        $self->userName = $gist['user']['login'];

        return $self;
    }
}
