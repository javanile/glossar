<?php

namespace Glossarize\Analysis;

use Webmozart\Glob\Glob;
use Webmozart\PathUtil\Path;

class Source
{
    use Rudiments\GlossaryAnalysis;
    use Rudiments\StringsLanguage;
    use Rudiments\ArrayValuesLanguage;
    use Rudiments\StrictSourceCode;

    /**
     *
     */
    protected $vars;

    /**
     *
     */
    protected $config;

    /**
     *
     */
    protected $pattern;

    /**
     *
     */
    protected $path;

    /**
     *
     */
    protected $files;

    /**
     * Config constructor.
     *
     * @param $config
     */
    public function __construct($config, $pattern, $path)
    {
        $this->vars = [];
        $this->config = $config;
        $this->pattern = $pattern;
        $this->path = $path;
        $this->files = null;
    }

    /**
     * @param $vars
     */
    public function setVars($vars)
    {
        foreach ($vars as $var => $value) {
            $this->set($var, $value);
        }
    }

    /**
     * @param $var
     */
    public function get($var)
    {
        return $this->vars[$var];
    }

    /**
     * @param $var
     */
    public function set($var, $value)
    {
        $this->vars[$var] = $value;
    }

    /**
     *
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     *
     */
    protected function getFiles()
    {
        if ($this->files === null) {
            $cwd = $this->getConfig()->getCwd();
            $this->files = [];
            $files = Glob::glob(Path::makeAbsolute($this->pattern, $this->path));
            foreach ($files as $file) {
                $this->files[] = [
                    'filename' => $file,
                    'relative' => Path::makeRelative($file, $cwd),
                ];
            }
        }

        return $this->files;
    }

    /**
     *
     */
    public function scan($dir)
    {
        $source = new Source($this->getConfig(), $this->pattern, $this->path . '/' . $dir);

        $source->setVars($this->vars);

        return $source;
    }

    /**
     * @param $var
     */
    public function ignoreWords($words)
    {
        if (empty($this->vars['ignore-words'])) {
            $this->vars['ignore-words'] = [];
        }

        $this->vars['ignore-words'] = array_merge($this->vars['ignore-words'], $words);

        return $this;
    }
}
