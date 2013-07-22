<?php


/**
 * Sanitizes strings for output.
 */

class SafeString
{
    private $string;

    public function __construct($string)
    {
        $this->string=$string;
    }

    /**
     * Get original, unsanitized value.
     *
     * @return string
     */
    public function literal() {
        return $this->string;
    }


    /**
     * Converts html entities and trims string
     * @return string
     */
    public function __toString()
    {
        return trim(htmlspecialchars($this->string, ENT_QUOTES | ENT_HTML5));
    }
}

