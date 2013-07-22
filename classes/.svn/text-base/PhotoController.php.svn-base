<?php

/**
 * Controller for Photos
 */
class PhotoController extends PageSetController
{

    /**
     * Get page content data.
     *
     * @return array
     */
    protected function addMeta($data)
    {

        $data = parent::addMeta($data);

        $content= $data['content']['vars'];
        $data['og']['image']=$content['items'][$content['selected']]['url'];
        $data['og']['isImage']=true;

        return $data;
    }

}

