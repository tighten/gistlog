<?php

use Gistlog\Gists\Gist;
use Gistlog\Gists\Comment;

class GistTest extends TestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');

        $gist = Gist::fromGitHub($githubGist);

        $this->assertEquals("002ed429c7c21ab89300", $gist->id);
        $this->assertEquals("A Sample Gistlog", $gist->title);
        $this->assertEquals("https://gist.github.com/002ed429c7c21ab89300", $gist->link);
        $this->assertEquals(new DateTime('2015-01-31T14:53:51Z'), $gist->createdAt);
        $this->assertEquals(new DateTime('2015-01-31T14:54:28Z'), $gist->updatedAt);
        $this->assertEquals('adamwathan', $gist->author);
        $this->assertEquals('https://avatars.githubusercontent.com/u/4323180?v=3', $gist->avatarUrl);
        $this->assertEquals("## This is my first Gistlog entry\n\nCool service, *amirite?*", $gist->content);
    }

    /** @test */
    public function it_can_be_created_with_comments()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubComments = $this->loadFixture('002ed429c7c21ab89300/comments.json');

        $gist = Gist::fromGitHub($githubGist, $githubComments);

        $this->assertEquals("A Sample Gistlog", $gist->title);
        $this->assertEquals("https://gist.github.com/002ed429c7c21ab89300", $gist->link);
        $this->assertEquals(new DateTime('2015-01-31T14:53:51Z'), $gist->createdAt);
        $this->assertEquals(new DateTime('2015-01-31T14:54:28Z'), $gist->updatedAt);
        $this->assertEquals('adamwathan', $gist->author);
        $this->assertEquals('https://avatars.githubusercontent.com/u/4323180?v=3', $gist->avatarUrl);
        $this->assertEquals("## This is my first Gistlog entry\n\nCool service, *amirite?*", $gist->content);

        $this->assertCount(2, $gist->comments);
        $this->assertContainsOnlyInstancesOf(Comment::class, $gist->comments);
    }

    /** @test */
    public function it_has_comments_when_there_are_one_or_more_comments()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubComments = $this->loadFixture('002ed429c7c21ab89300/comments.json');

        $gist = Gist::fromGitHub($githubGist, $githubComments);

        $this->assertTrue($gist->hasComments());
    }

    /** @test */
    public function it_has_no_comments_when_there_are_zero_comments()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');

        $gist = Gist::fromGitHub($githubGist);

        $this->assertFalse($gist->hasComments());
    }

    /** @test */
    public function secret_gists_are_not_public()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubGist['public'] = false;

        $gist = Gist::fromGitHub($githubGist);

        $this->assertFalse($gist->isPublic());
    }

    /** @test */
    public function public_gists_are_public()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubGist['public'] = true;

        $gist = Gist::fromGitHub($githubGist);

        $this->assertTrue($gist->isPublic());
    }

    /** @test */
    public function secret_gists_are_secret()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubGist['public'] = false;

        $gist = Gist::fromGitHub($githubGist);

        $this->assertTrue($gist->isSecret());
    }

    /** @test */
    public function public_gists_are_not_secret()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubGist['public'] = true;

        $gist = Gist::fromGitHub($githubGist);

        $this->assertFalse($gist->isSecret());
    }
}
