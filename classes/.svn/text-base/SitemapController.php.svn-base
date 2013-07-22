<?php

/**
 * Presents a sitemap.
 */
class SitemapController extends PageController
{

    /**
     * Show sitemap page
     */
    public function index()
    {
        $this->show('sitemap','html');
    }

    protected function getContentVars($fileName, $args)
    {
        $vars = parent::getContentVars($fileName, $args);

        $generator= new SitemapGenerator($this->config);
        $vars['pages'] = $generator->getAllPages();

        return $vars;
    }

    public function getPages($action)
    {
        return array();
    }

}

