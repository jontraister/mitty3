<?php

/**
 * Ephemeral cache for Google API.
 *
 * Prevents issues with file cache and isn't needed because in production we're cacheing the rendered pages.
 */
class GoogleDummyCache extends Google_Cache
{

    private $store = array();

    /**
     * Retrieves the data for the given key, or false if they
     * key is unknown or expired
     *
     * @param String $key The key who's data to retrieve
     * @param boolean|int $expiration Expiration time in seconds
     *
     */
    function get($key, $expiration = false)
    {
        if (!isset($this->store[$key]))
            return false;

        return $this->store[$key];
    }

    /**
     * Store the key => $value set. The $value is serialized
     * by this function so can be of any type
     *
     * @param string $key Key of the data
     * @param string $value data
     */
    function set($key, $value)
    {
        $this->store[$key] = $value;
    }

    /**
     * Removes the key/data pair for the given $key
     *
     * @param String $key
     */
    function delete($key)
    {
        if (isset($this->store[$key]))
            unset($this->store[$key]);
    }

}
