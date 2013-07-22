<?php

/**
 * Cache with memcache backend.
 */
class MemcacheCache extends Cache
{

    /**
     * @var Memcache
     */
    protected $backend = null;

    /**
     * Creates a cache from session.
     *
     * Returns a dummy cache object that doesn't store if no memcache backend is defined in the session.
     */
    public static function createFromSession()
    {
        $handler = ini_get('session.save_handler');

        switch ($handler) {

            case 'memcached':
                $config=ini_get('session.save_path');
                $servers=explode(',', $config);

                if (empty($servers))
                    return new Cache();

                $memcache = new Memcache();
                foreach ($servers as $server) {
                      list($host,$port)= explode(':',$server);
                      $memcache->addserver(trim($host), trim($port));
                }

                return new self($memcache);

            default:

                return new Cache();
        }
    }

    /**
     * Get Memcache backend.
     * @return Memcache
     */
    public function getBackend()
    {
        return $this->backend;
    }

    /**
     * Construct with backend.
     * @param Memache $backend the cache we're delegating to.
     */
    public function __construct($backend)
    {
        $this->backend = $backend;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $value=@$this->backend->get($key);
        return (false===$value)?null:$value;
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, $expires = null)
    {
        @$this->backend->set($key, $value, 0, $expires);
    }

}