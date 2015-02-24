<?php

use Gistlog\Gists\Comment;

class MarkdownRenderableTraitTest extends TestCase
{
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
