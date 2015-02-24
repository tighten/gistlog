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

    /** @test */
    public function it_converts_github_usernames_into_links()
    {
        $obj = new MarkdownRenderableStub;

        $this->assertEquals(
            '<p>Hey <a href="http://github.com/kayladnls" target="_blank">@kayladnls</a></p>',
            $obj->renderFromMarkdown('Hey @kayladnls')
        );
    }

    /** @test */
    public function it_doesnt_mistake_email_addresses_for_github_usernames()
    {
        $obj = new MarkdownRenderableStub;

        $this->assertEquals(
            '<p>My email is example@example.com</p>',
            $obj->renderFromMarkdown('My email is example@example.com')
        );
    }

    /** @test */
    public function it_doesnt_include_trailing_characters_in_github_usernames_that_arent_valid_username_characters()
    {
        $obj = new MarkdownRenderableStub;

        $this->assertEquals(
            '<p>Hey <a href="http://github.com/kayladnls" target="_blank">@kayladnls</a>!</p>',
            $obj->renderFromMarkdown('Hey @kayladnls!')
        );
    }


}

class MarkdownRenderableStub
{
    use Gistlog\Gists\MarkdownRenderable;
}

