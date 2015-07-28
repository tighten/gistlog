<?php namespace Gistlog\Gists;

use Illuminate\Support\Arr;
use Symfony\Component\Yaml\Yaml;

class GistConfig implements \ArrayAccess
{

    /**
     * @var array
     */
    private $default_settings = array(
        'published'    => false,
        'published_on' => null,
        'preview'      => null
    );

    /**
     * @var array
     */
    public $settings = array();

    /**
     * @param array|ArrayAccess $githubGist
     * @return GistConfig
     */
    public static function fromGitHub($githubGist)
    {
        $config = new self;
        $config->settings = $config->default_settings;

        if (! array_key_exists('gistlog.yml', $githubGist['files'])) {
            return $config;
        }

        $user_settings = Yaml::parse($githubGist['files']['gistlog.yml']['content']);
        if (! is_array($user_settings)) {
            return $config;
        }

        foreach ($config->default_settings as $setting => $default_value) {
            $config->settings[$setting] = Arr::get($user_settings, $setting, $default_value);
        }

        return $config;
    }


    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->settings[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->settings[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        Arr::set($this->settings, $offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        Arr::set($this->settings, $offset, null);
    }
}
