<?php

use Gistlog\Gists\Comment;

class CommentTest extends TestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubComment = $this->loadFixture('002ed429c7c21ab89300/comments.json')[0];

        $comment = Comment::fromGitHub('002ed429c7c21ab89300', $githubComment);

        $this->assertEquals("Interesting post.", $comment->body);
        $this->assertEquals("adamwathan", $comment->author);
        $this->assertEquals("https://avatars.githubusercontent.com/u/4323180?v=3", $comment->avatarUrl);
        $this->assertEquals(new DateTime('2015-01-31T14:54:23Z'), $comment->updatedAt);
    }

    /** @test */
    public function can_get_absolute_url_to_gist_comment_on_github()
    {
        $githubComment = $this->loadFixture('002ed429c7c21ab89300/comments.json')[0];

        $comment = Comment::fromGitHub('002ed429c7c21ab89300', $githubComment);

        $this->assertEquals(
            'https://gist.github.com/002ed429c7c21ab89300#comment-' . $comment->id,
            $comment->link()
        );
    }
}
