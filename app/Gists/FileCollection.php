<?php

namespace App\Gists;

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

    public function getPostFile(): File
    {
        $post = $this->first(function ($file, $key) {
            return $file->language == 'Markdown';
        });

        if (! empty($post)) {
            return $post;
        }

        return $this->first();
    }

    public function getAdditionalFiles(): self
    {
        $ignoreFiles = ['gistlog.yml', $this->getPostFile()->name];

        return $this->filter(function ($file) use ($ignoreFiles) {
            return ! in_array($file->name, $ignoreFiles);
        });
    }
}
