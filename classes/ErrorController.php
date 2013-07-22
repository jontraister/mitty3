<?php

/**
 * Route fallback controller
 */
class ErrorController extends PageController
{

    /**
     * Show error.html
     */
    public function index($path='')
    {

        header("HTTP/1.0 404 Not Found");

        if (false && $this->config->debug)
            echo "Application setup error - no matching route for '" . htmlentities($path)."'";
        else
            return $this->show('error');
    }

    public function setHeaders()
    {
            header("HTTP/1.0 404 Not Found");
    }

    public function getPages($fileName)
    {
        return array();
    }
}

