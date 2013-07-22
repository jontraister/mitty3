<?php

/**
 * Renders a series of pages like photos or videos
 */
class PageSetController extends PageController
{


    protected function getContentVars($fileName, $args)
    {
        $vars = parent::getContentVars($fileName, $args);

        $selected=$this->getSelected($args);
        $vars ['selected'] =  $selected;
        if (isset($vars['items'])) {
           $vars['og']['title']=$vars['meta']['title']= $vars['meta']['title'] . ' | ' .$vars['items'][$selected]['title'];
           if (isset($vars['items'][$selected]['description']))
               $vars['og']['description']=$vars['meta']['description']=$vars['items'][$selected]['description'];
        }
        return $vars;

    }

    public function getSelected($args) {
        if (!isset($args[0]))
            return 0;

        $match = $args[0];

        if (is_numeric($match))
            return intval($match) - 1;

        return 0;
    }

    public function getPages($fileName) {

        $content=$this->getContentVars($fileName, array());

        $title = @$content['title'];

        $pages=array();
        foreach ($content['items'] as $i=>$item)
            $pages[] = array('url' => preg_replace('/\.html/','-'.($i+1).'.html', $fileName) , 'title'=> $item['title']);

        return array( array( 'url' => $fileName, 'title' => $title, 'pages'=>$pages));
    }

}
