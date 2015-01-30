<?php  namespace Gistlog\Gists;

use Michelf\MarkdownExtra;

class FilePresenter
{
    /**
     * @param array $file
     * @return string
     * @throws \Exception
     */
    public static function present(array $file)
    {
        $transformMethodName = 'transform' . ucfirst($file['language']) . 'ToHTML';

        if (! method_exists(self::class, $transformMethodName)) {
            throw new \Exception("FilePresenter doesn't know how to transform files of type {$file['language']}.");
        }

        return self::$transformMethodName($file['content']);
    }

    /**
     * @param string $markdown
     * @return string
     */
    private static function transformMarkdownToHTML($markdown)
    {
        return MarkdownExtra::defaultTransform($markdown);
    }
}
