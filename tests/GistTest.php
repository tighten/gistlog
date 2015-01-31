<?php

use Gistlog\Gists\Gist;
use Gistlog\Gists\Comment;

class GistTest extends TestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubGist = $this->loadFixture('548944.json');

        $gist = Gist::fromGitHub($githubGist);

        $this->assertEquals("548944", $gist->id);
        $this->assertEquals("My First Gistlog", $gist->title);
        $this->assertEquals("https://gist.github.com/548944", $gist->link);
        $this->assertEquals(new DateTime('2010-08-25T05:55:02Z'), $gist->createdAt);
        $this->assertEquals(new DateTime('2010-08-25T12:44:08Z'), $gist->updatedAt);
        $this->assertEquals('adamwathan', $gist->author);
        $this->assertEquals('https://avatars.githubusercontent.com/u/4323180?v=3', $gist->avatarUrl);
        $this->assertEquals("This is my first Gistlog entry\n\nCool service, amirite?", $gist->content);
    }

    /** @test */
    public function it_can_be_created_with_comments()
    {
        $githubGist = $this->loadFixture('548944.json');
        $githubComments = $this->loadFixture('548944/comments.json');

        $gist = Gist::fromGitHub($githubGist, $githubComments);

        $this->assertEquals("My First Gistlog", $gist->title);
        $this->assertEquals("https://gist.github.com/548944", $gist->link);
        $this->assertEquals(new DateTime('2010-08-25T05:55:02Z'), $gist->createdAt);
        $this->assertEquals(new DateTime('2010-08-25T12:44:08Z'), $gist->updatedAt);
        $this->assertEquals('adamwathan', $gist->author);
        $this->assertEquals('https://avatars.githubusercontent.com/u/4323180?v=3', $gist->avatarUrl);
        $this->assertEquals("This is my first Gistlog entry\n\nCool service, amirite?", $gist->content);

        $this->assertCount(2, $gist->comments);
        $this->assertContainsOnlyInstancesOf(Comment::class, $gist->comments);
    }
}
