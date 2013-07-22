<?php

/**
 * Cache decorator that prefixes get/set/delete operations
 */
class PrefixCache extends Cache
{

    /**
     * @var Cache
     */
    protected $backend = null;

    /**
     * Construct with backend.
     * @param Cache $backend the cache we're delegating to.
     * @param string $prefix
     */
    public function __construct($backend, $prefix)
    {
        $this->backend = $backend;
        $this->prefix = $prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        return $this->backend->get($this->prefix . $key);
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, $expires = null)
    {
        $this->backend->set($this->prefix . $key, $value, $expires);
    }

}

