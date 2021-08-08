<?php

namespace App\Gists;

use Illuminate\Contracts\Support\Arrayable;

class File implements Arrayable
{
    public $name;

    public $type;

    public $language;

    public $url;

    public $size;

    public $content;

    /**
     * @param array|ArrayAccess $rawFile
     * @return File
     */
    public static function fromGitHub($rawFile)
    {
        $file = new self();

        $file->name = $rawFile['filename'];
        $file->type = $rawFile['type'];
        $file->language = $rawFile['language'];
        $file->url = $rawFile['raw_url'];
        $file->size = $rawFile['size'];
        $file->content = $rawFile['content'];

        return $file;
    }

    /**
     * @param array|ArrayAccess $rawFiles
     * @return FileCollection
     */
    public static function multipleFromGitHub($rawFiles)
    {
        return new FileCollection($rawFiles);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->name,
            'type'  => $this->type,
            'language' => $this->language,
            'url' => $this->url,
            'size' => $this->size,
            'content' => $this->content,
        ];
    }
}
