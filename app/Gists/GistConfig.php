<?php

namespace App\Gists;

use ArrayAccess;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Support\Arr;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class GistConfig implements ArrayAccess
{
    /**
     * @var array
     */
    private $defaultSettings = [
        'published' => false,
        'published_on' => null,
        'preview' => null,
        'include_files' => false,
    ];

    /**
     * @var array
     */
    public $settings = [];

    /**
     * @var array
     */
    private $dates = ['published_on'];

    /**
     * @param array|ArrayAccess $githubGist
     * @return GistConfig
     */
    public static function fromGitHub($githubGist): self
    {
        $config = new self();
        $config->settings = $config->defaultSettings;

        if (! array_key_exists('gistlog.yml', $githubGist['files'])) {
            return $config;
        }

        try {
            $userSettings = Yaml::parse($githubGist['files']['gistlog.yml']['content']);
        } catch (ParseException $exception) {
            $userSettings = null;
        }

        if (! is_array($userSettings)) {
            return $config;
        }

        foreach ($config->defaultSettings as $setting => $defaultValue) {
            $config->settings[$setting] = Arr::get($userSettings, $setting, $defaultValue);
        }

        foreach ($config->dates as $setting) {
            if (is_null($config->settings[$setting])) {
                continue;
            }

            try {
                $config->settings[$setting] = Carbon::createFromTimestamp($config->settings[$setting]);

                // @todo is there a cleaner way to do this?
                if ($config->settings[$setting]->format('Y-m-d') === '1970-01-01') {
                    $config->settings[$setting] = null;
                }
            } catch (ErrorException $e) {
                $config->settings[$setting] = null;
            }
        }

        return $config;
    }

    /**
     * @param mixed $setting
     * @return bool
     */
    public function offsetExists($setting)
    {
        return isset($this->settings[$setting]);
    }

    /**
     * @param mixed $setting
     * @return mixed
     */
    public function offsetGet($setting)
    {
        return $this->settings[$setting];
    }

    /**
     * @param mixed $setting
     * @param mixed $value
     */
    public function offsetSet($setting, $value)
    {
        Arr::set($this->settings, $setting, $value);
    }

    /**
     * @param mixed $setting
     */
    public function offsetUnset($setting)
    {
        Arr::set($this->settings, $setting, null);
    }
}
