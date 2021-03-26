<?php

use App\Gists\Gistlog;

class GistlogTest extends BrowserKitTestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubGist = $this->loadFixture('002ed429c7c21ab89300.json');

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertEquals('002ed429c7c21ab89300', $gistlog->id);
        $this->assertEquals('A Sample Gistlog', $gistlog->title);
        $this->assertEquals('https://gist.github.com/002ed429c7c21ab89300', $gistlog->link);
        $this->assertEquals(new DateTime('2015-01-31T14:53:51Z'), $gistlog->createdAt);
        $this->assertEquals(new DateTime('2015-01-31T14:54:28Z'), $gistlog->updatedAt);
        $this->assertEquals('adamwathan', $gistlog->author);
        $this->assertEquals('https://avatars.githubusercontent.com/u/4323180?v=3', $gistlog->avatarUrl);
        $this->assertEquals("## This is my first Gistlog entry\n\nCool service, *amirite?*", $gistlog->content);
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

        $this->assertEquals('<pre><code>'.htmlspecialchars($gistlog->content)."\n</code></pre>", $gistlog->renderHtml());
    }

    /** @test */
    public function it_finds_the_first_markdown_file_and_uses_it_as_the_post()
    {
        $githubGist = $this->loadFixture('272f372732bf4d69bd0f.json');

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertContains('My First Post', $gistlog->content);
    }

    /** @test */
    public function it_loads_files()
    {
        $githubGist = $this->loadFixture('aac5edd61c183dd26392.json');

        $gistlog = Gistlog::fromGitHub($githubGist);
        $files = $gistlog->files;

        $this->assertTrue($gistlog->showFiles());
        $this->assertEquals(2, $files->count());
        $this->assertEquals(['planets.md', 'ship.css'], $files->pluck('name')->toArray());
    }

    /** @test */
    public function it_has_additional_files_but_doesnt_show_them()
    {
        $githubGist = $this->loadFixture('272f372732bf4d69bd0f.json');

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertEquals(0, $gistlog->files->count());
    }

    public function it_accepts_anonymous_gists()
    {
        $githubGist = $this->loadFixture('2c2769b21e512eabdd72.json');

        $gistlog = Gistlog::fromGitHub($githubGist);

        $this->assertEquals('anonymous', $gistlog->author);
    }
}
