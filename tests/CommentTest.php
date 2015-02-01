<?php

use Gistlog\Gists\Comment;

class CommentTest extends TestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubComment = $this->loadFixture('002ed429c7c21ab89300/comments.json')[0];

        $comment = Comment::fromGitHub($githubComment);

        $this->assertEquals("Interesting post.", $comment->body);
        $this->assertEquals("adamwathan", $comment->author);
        $this->assertEquals("https://avatars.githubusercontent.com/u/4323180?v=3", $comment->avatarUrl);
        $this->assertEquals(new DateTime('2015-01-31T14:54:23Z'), $comment->updatedAt);
    }
}
