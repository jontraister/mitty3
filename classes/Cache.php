<?php

/**
 * Minimal cache frontend, does not store anything.
 */
class Cache
{

    /**
     * Create a prefixed cache frontend.
     *
     * All operations on the returned cache will automatically have their keys prefixed. The current object is not affected.
     *
     * @param string $prefix
     * @return Cache
     */
    public function prefix($prefix) {
        return new PrefixCache($this, $prefix);
    }

    /**
     * Gets value from cache or uses the evaluator to produce and store value.
     *
     * @param string $key
     * @param Closure $evaluator a closure that produces the value when called without parameters.
     * @param int $expires expiry time in seconds from now or defaults if not set or null
     * @return mixed returns cached or evaluated value.
     */
    public function evaluate($key, $evaluator, $expires = null)
    {

        $value = $this->get($key);

        if (null === $value) {
            $value = $evaluator();
            $this->set($key, $value, $expires);
        }

        return $value;
    }

    /**
     * Store value in cache.
     *
     * @param string $key
     * @param mixed $value any serializable value, null values should not be stored to the backedn as they indicate a cache miss.
     * @param int $expires expiry time in seconds from now or defaults if not set or null
     */
    public function set($key, $value, $expires = null)
    {

    }

    /**
     * Get value from cache.
     *
     * @param string $key
     * @return mixed returns null if not found.
     */
    public function get($key)
    {
        return null;
    }


}