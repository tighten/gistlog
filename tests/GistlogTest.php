<?php

use Gistlog\Gists\Gistlog;
use Gistlog\Gists\Comment;

class GistlogTest extends TestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertEquals("002ed429c7c21ab89300", $gistlog->id);
        $this->assertEquals("A Sample Gistlog", $gistlog->title);
        $this->assertEquals("https://gist.github.com/002ed429c7c21ab89300", $gistlog->link);
        $this->assertEquals(new DateTime('2015-01-31T14:53:51Z'), $gistlog->createdAt);
        $this->assertEquals(new DateTime('2015-01-31T14:54:28Z'), $gistlog->updatedAt);
        $this->assertEquals('adamwathan', $gistlog->author);
        $this->assertEquals('https://avatars.githubusercontent.com/u/4323180?v=3', $gistlog->avatarUrl);
        $this->assertEquals("## This is my first Gistlog entry\n\nCool service, *amirite?*", $gistlog->content);
    }

    /** @test */
    public function it_can_be_created_with_comments()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubComments = $this->loadFixture('002ed429c7c21ab89300/comments.json');

        $gistlog = Gistlog::fromGitHub($githubGist, $githubComments);

        $this->assertEquals("A Sample Gistlog", $gistlog->title);
        $this->assertEquals("https://gist.github.com/002ed429c7c21ab89300", $gistlog->link);
        $this->assertEquals(new DateTime('2015-01-31T14:53:51Z'), $gistlog->createdAt);
        $this->assertEquals(new DateTime('2015-01-31T14:54:28Z'), $gistlog->updatedAt);
        $this->assertEquals('adamwathan', $gistlog->author);
        $this->assertEquals('https://avatars.githubusercontent.com/u/4323180?v=3', $gistlog->avatarUrl);
        $this->assertEquals("## This is my first Gistlog entry\n\nCool service, *amirite?*", $gistlog->content);

        $this->assertCount(2, $gistlog->comments);
        $this->assertContainsOnlyInstancesOf(Comment::class, $gistlog->comments);
    }

    /** @test */
    public function it_has_comments_when_there_are_one_or_more_comments()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubComments = $this->loadFixture('002ed429c7c21ab89300/comments.json');

        $gistlog = Gistlog::fromGitHub($githubGist, $githubComments);

        $this->assertTrue($gistlog->hasComments());
    }

    /** @test */
    public function it_has_no_comments_when_there_are_zero_comments()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertFalse($gistlog->hasComments());
    }

    /** @test */
    public function secret_gists_are_not_public()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubGist['public'] = false;

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertFalse($gistlog->isPublic());
    }

    /** @test */
    public function public_gists_are_public()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubGist['public'] = true;

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertTrue($gistlog->isPublic());
    }

    /** @test */
    public function secret_gists_are_secret()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubGist['public'] = false;

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertTrue($gistlog->isSecret());
    }

    /** @test */
    public function public_gists_are_not_secret()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');
        $githubGist['public'] = true;

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertFalse($gistlog->isSecret());
    }

    /** @test */
    public function code_only_posts_render_in_a_code_block()
    {
        $githubGist = $this->loadFixture('aac58f02ec1aaaad7f88.json');

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertEquals("<pre><code>" . htmlspecialchars($gistlog->content) . "\n</code></pre>", $gistlog->renderHtml());
    }

    /** @test */
    public function it_accepts_anonymous_gists()
    {
        $githubGist = $this->loadFixture('2c2769b21e512eabdd72.json');

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertEquals("anonymous", $gistlog->author);
    }
}
