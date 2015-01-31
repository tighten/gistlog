<?php

use Gistlog\Gists\Comment;

class CommentTest extends TestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubComment = $this->loadFixture('548944/comments.json')[0];

        $comment = Comment::fromGitHub($githubComment);

        $this->assertEquals("I like it! When will it be pushed?", $comment->body);
        $this->assertEquals("mattstauffer", $comment->user);
        $this->assertEquals("https://avatars.githubusercontent.com/u/151829?v=3", $comment->avatarUrl);
        $this->assertEquals(new DateTime('2010-08-25T15:29:38Z'), $comment->updatedAt);
    }
}
