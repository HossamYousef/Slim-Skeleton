<?php

namespace App\Common;

class MailRenderer
{
    /**
     * Twig loader
     *
     * @var \Twig_LoaderInterface
     */
    protected $loader;

    /**
     * Twig environment
     *
     * @var \Twig_Environment
     */
    protected $environment;

    /**
     * Default view variables
     *
     * @var array
     */
    protected $defaultVariables = [];

    /**
     * MailRenderer constructor.
     *
     * @param string $templatePath
     * @param array  $attributes
     */
    public function __construct($path, $settings = [])
    {
        $this->loader      = $this->createLoader(is_string($path) ? [$path] : $path);
        $this->environment = new \Twig_Environment($this->loader, $settings);
    }

    /**
     * Create a loader with the given path
     *
     * @param  array $paths
     * @return \Twig_Loader_Filesystem
     */
    private function createLoader(array $paths)
    {
        $loader = new \Twig_Loader_Filesystem();
        foreach ($paths as $namespace => $path) {
            if (is_string($namespace)) {
                $loader->setPaths($path, $namespace);
            } else {
                $loader->addPath($path);
            }
        }
        return $loader;
    }

    /**
     * Render a template
     *
     * @param string $template
     * @param array  $data
     *
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function render($template, array $data = [])
    {
        return $this->fetch($template, $data);
    }

    /**
     * Fetch rendered template
     *
     * @param string $template Template pathname relative to templates directory
     * @param array  $data     Associative array of template variables
     *
     * @return string
     */
    public function fetch($template, $data = [])
    {
        $data = array_merge($this->defaultVariables, $data);
        return $this->environment->loadTemplate($template)->render($data);
    }

    /**
     * Fetch rendered string
     *
     * @param string $string String
     * @param array  $data   Associative array of template variables
     *
     * @return string
     */
    public function fetchFromString($string = "", $data = [])
    {
        $data = array_merge($this->defaultVariables, $data);
        return $this->environment->createTemplate($string)->render($data);
    }

    /**
     * Does this collection have a given key?
     *
     * @param string $key The data key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->defaultVariables);
    }

    /**
     * Get collection item for key
     *
     * @param string $key The data key
     *
     * @return mixed The key's value, or the default value
     */
    public function offsetGet($key)
    {
        return $this->defaultVariables[$key];
    }

    /**
     * Set collection item
     *
     * @param string $key   The data key
     * @param mixed  $value The data value
     */
    public function offsetSet($key, $value)
    {
        $this->defaultVariables[$key] = $value;
    }

    /**
     * Remove item from collection
     *
     * @param string $key The data key
     */
    public function offsetUnset($key)
    {
        unset($this->defaultVariables[$key]);
    }

    /**
     * Get number of items in collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->defaultVariables);
    }

    /**
     * Get collection iterator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->defaultVariables);
    }
}
