<?php namespace Gistlog\Gists;

use Illuminate\Support\Collection;

class FileCollection extends Collection
{
    public function __construct($files)
    {
        parent::__construct($files);

        $this->items = array_map(function ($file) {

            if (is_array($file)) {
                return File::fromGitHub($file);
            }

            return $file;

        }, $this->items);
    }

    /**
     * @return File
     */
    public function getPostFile()
    {
        $post = $this->first(function ($key, $file) {
            return $file->language == 'Markdown';
        });

        if (!empty($post)) {
            return $post;
        }

        return $this->first();
    }

    /**
     * @return static
     */
    public function getAdditionalFiles()
    {
        $ignoreFiles = ['gistlog.yml', $this->getPostFile()->name];

        return $this->filter(function ($file) use ($ignoreFiles) {
            return !in_array($file->name, $ignoreFiles);
        });
    }
}
