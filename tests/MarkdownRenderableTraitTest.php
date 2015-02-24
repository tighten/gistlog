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

    /** @test */
    public function it_recognizes_github_usernames_that_begin_with_a_number()
    {
        $obj = new MarkdownRenderableStub;

        $this->assertEquals(
            '<p>Hey <a href="http://github.com/1foo" target="_blank">@1foo</a></p>',
            $obj->renderFromMarkdown('Hey @1foo')
        );
    }

    /** @test */
    public function it_recognizes_github_usernames_that_include_dashes()
    {
        $obj = new MarkdownRenderableStub;

        $this->assertEquals(
            '<p>Hey <a href="http://github.com/adam-wathan" target="_blank">@adam-wathan</a></p>',
            $obj->renderFromMarkdown('Hey @adam-wathan')
        );
    }

    /** @test */
    public function github_usernames_cannot_begin_with_a_dash()
    {
        $obj = new MarkdownRenderableStub;

        $this->assertEquals(
            '<p>Hey @-adamwathan</p>',
            $obj->renderFromMarkdown('Hey @-adamwathan')
        );
    }

    /** @test */
    public function github_usernames_can_be_a_single_character()
    {
        $obj = new MarkdownRenderableStub;

        $this->assertEquals(
            '<p>Hey <a href="http://github.com/A" target="_blank">@A</a></p>',
            $obj->renderFromMarkdown('Hey @A')
        );
    }

    /** @test */
    public function github_username_can_be_the_first_string_in_the_content()
    {
        $obj = new MarkdownRenderableStub;

        $this->assertEquals(
            '<p><a href="http://github.com/adamwathan" target="_blank">@adamwathan</a></p>',
            $obj->renderFromMarkdown('@adamwathan')
        );
    }

    /** @test */
    public function github_username_can_be_in_brackets()
    {
        $obj = new MarkdownRenderableStub;

        $this->assertEquals(
            '<p>Adam Wathan (<a href="http://github.com/adamwathan" target="_blank">@adamwathan</a>)</p>',
            $obj->renderFromMarkdown('Adam Wathan (@adamwathan)')
        );

        $this->assertEquals(
            '<p>Adam Wathan [<a href="http://github.com/adamwathan" target="_blank">@adamwathan</a>]</p>',
            $obj->renderFromMarkdown('Adam Wathan [@adamwathan]')
        );

        $this->assertEquals(
            '<p>Adam Wathan {<a href="http://github.com/adamwathan" target="_blank">@adamwathan</a>}</p>',
            $obj->renderFromMarkdown('Adam Wathan {@adamwathan}')
        );

        $this->assertEquals(
            '<p>Adam Wathan &lt;<a href="http://github.com/adamwathan" target="_blank">@adamwathan</a>></p>',
            $obj->renderFromMarkdown('Adam Wathan <@adamwathan>')
        );
    }
}

class MarkdownRenderableStub
{
    use Gistlog\Gists\MarkdownRenderable;
}
