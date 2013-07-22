<?php

/**
 * Bidirectional router that allows controllers to advertise the pages they're serving.
 *
 * Used for building the sitemap and static dumps.
 */

class SitemapGenerator extends Router {

    public function getAllPages () {
        $config=(array) $this->config->pages;

        $pages=array();
        foreach ($config as $fileName=>$page) {
            $action = Config::getPageAction($page);

            list($controller,$method) = $this->getAction($action,array());
            unset ($method);

            if (method_exists($controller, 'getPages'))
                $pages = array_merge ($pages, $controller->getPages($fileName));
        }

        return $pages;
    }

    public function getAllPagesFlat() {
       $list=array();
       $unroll = function ($pages) use (&$unroll, &$list) {
           foreach ($pages as $page) {
                 if (isset($page['pages'])) $unroll($page['pages'], $list);
                 $list[]=$page;
           }
       };
       $unroll($this->getAllPages());
       return $list;

    }


}

