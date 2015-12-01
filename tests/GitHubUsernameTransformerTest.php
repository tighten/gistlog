<?php

use Gistlog\ContentParser\GitHubUsernameTransformer;

class GitHubUsernameTransformerTest extends TestCase
{
    /** @test */
    public function it_converts_github_usernames_into_links()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'Hey <a href="http://github.com/kayladnls" target="_blank">@kayladnls</a>',
            $transformer->transform('Hey @kayladnls')
        );
    }

    /** @test */
    public function it_doesnt_mistake_email_addresses_for_github_usernames()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'My email is example@example.com',
            $transformer->transform('My email is example@example.com')
        );
    }

    /** @test */
    public function it_doesnt_include_trailing_characters_in_github_usernames_that_arent_valid_username_characters()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'Hey <a href="http://github.com/kayladnls" target="_blank">@kayladnls</a>!',
            $transformer->transform('Hey @kayladnls!')
        );
    }

    /** @test */
    public function it_recognizes_github_usernames_that_begin_with_a_number()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'Hey <a href="http://github.com/1foo" target="_blank">@1foo</a>',
            $transformer->transform('Hey @1foo')
        );
    }

    /** @test */
    public function it_recognizes_github_usernames_that_include_dashes()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'Hey <a href="http://github.com/adam-wathan" target="_blank">@adam-wathan</a>',
            $transformer->transform('Hey @adam-wathan')
        );
    }

    /** @test */
    public function github_usernames_cannot_begin_with_a_dash()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'Hey @-adamwathan',
            $transformer->transform('Hey @-adamwathan')
        );
    }

    /** @test */
    public function github_usernames_can_be_a_single_character()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'Hey <a href="http://github.com/A" target="_blank">@A</a>',
            $transformer->transform('Hey @A')
        );
    }

    /** @test */
    public function github_username_can_be_the_first_string_in_the_content()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            '<a href="http://github.com/adamwathan" target="_blank">@adamwathan</a>',
            $transformer->transform('@adamwathan')
        );
    }

    /** @test */
    public function github_username_can_be_in_brackets()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'Adam Wathan (<a href="http://github.com/adamwathan" target="_blank">@adamwathan</a>)',
            $transformer->transform('Adam Wathan (@adamwathan)')
        );

        $this->assertEquals(
            'Adam Wathan [<a href="http://github.com/adamwathan" target="_blank">@adamwathan</a>]',
            $transformer->transform('Adam Wathan [@adamwathan]')
        );

        $this->assertEquals(
            'Adam Wathan {<a href="http://github.com/adamwathan" target="_blank">@adamwathan</a>}',
            $transformer->transform('Adam Wathan {@adamwathan}')
        );

        $this->assertEquals(
            'Adam Wathan <<a href="http://github.com/adamwathan" target="_blank">@adamwathan</a>>',
            $transformer->transform('Adam Wathan <@adamwathan>')
        );
    }

    /** @test */
    public function it_doesnt_convert_usernames_in_links()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'I am <a href="http://twitter.com/stauffermatt">@stauffermatt</a> on Twitter',
            $transformer->transform('I am <a href="http://twitter.com/stauffermatt">@stauffermatt</a> on Twitter')
        );

        $this->assertEquals(
            'I am <a href="http://twitter.com/michaeldyrynda">little known @michaeldyrynda</a> on Twitter',
            $transformer->transform('I am <a href="http://twitter.com/michaeldyrynda">little known @michaeldyrynda</a> on Twitter')
        );
    }


    /** @test */
    public function it_doesnt_match_an_at_symbol_on_its_own()
    {
        $transformer = new GitHubUsernameTransformer;

        $this->assertEquals(
            'Meet me @ the place',
            $transformer->transform('Meet me @ the place')
        );
    }
}
