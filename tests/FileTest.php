<?php

use Gistlog\Gists\File;
use Gistlog\Gists\Gistlog;

class FileTest extends TestCase
{
    use GistFixtureHelpers;

    /** @test */
    public function it_can_be_created_from_github_api_data()
    {
        $githubGist = $this->loadFixture('aac5edd61c183dd26392.json');
        $file = File::fromGitHub($githubGist['files']['planets.md']);

        $this->assertEquals(get_class($file), File::class);
        $this->assertEquals('planets.md', $file->name);
        $this->assertEquals('text/plain', $file->type);
        $this->assertEquals('Markdown', $file->language);
        $this->assertEquals('https://gist.githubusercontent.com/dannyweeks/aac5edd61c183dd26392/raw/35f2c3423019a71e7a820f3472c0cdea05e4274b/planets.md', $file->url);
        $this->assertEquals(750, $file->size);
        $this->assertEquals("- Aquarion\n    - None officially, major city is Heim\n    - The Ice Colony\n- Aerilon\n    - Gaoth\n    - The Food Basket of the Colonies\n- Canceron\n    - Hades\n    - The Largest Democracy\n- Caprica\n    - Caprica City\n    - The Capital of the Colonies\n- Gemenon\n    - Oranu\n    - The First Colony\n- Leonis\n    - Luminere\n    - The Heart of the Colonies\n- Libran\n    - None officially, major city is Themis\n    - The Colony of Justice\n- Picon\n    - Queenstown\n    - The Ocean Colony\n- Sagittaron\n    - Tawa\n    - The Lone Colony\n- Scorpia\n    - Celeste\n    - The Playground of the Colonies\n- Tauron\n    - Hypatia\n    - The Old Colony\n- Virgon\n    - Boskirk\n    - Imperial Virgon\n\nFind out more on [Wikipedia](https://en.wikipedia.org/wiki/Twelve_Colonies)", $file->content);
    }

    /** @test */
    public function it_loads_multiple_files()
    {
        $githubGist = $this->loadFixture('aac5edd61c183dd26392.json');
        $files = File::multipleFromGitHub($githubGist['files']);

        $this->assertEquals(4, $files->count());
        $this->assertEquals(['blog.md', 'gistlog.yml', 'planets.md', 'ship.css'], $files->pluck('name')->toArray());
        $this->assertEquals(get_class($files->first()), File::class);
    }
}
