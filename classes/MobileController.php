<?php

/**
 * Renders page content into 'layout.php' wrapper.
 */
class MobileController extends PageController
{

    public function getPages($fileName) {
        return array();
    }

    /**
     * Show index page
     */
    public function index()
    {
        $this->show('index');
    }


    /**
     * Render page with template as content body.
     *
     * @param string $templateName template file name without extention
     */
    public function show($templateName)
    {

        $fileName = 'mobile/'.$templateName . '.html';

        $self = $this;

        $renderFunction= function() use($fileName, $self) {
            ob_start();
            $data = (array) $self->config['general'];

            $data['content'] = array(
                'vars' => $self->getContentVars($fileName, array())
            );
            header('X-Server-Cached: no');
            header('X-Frame-Options: GOFORIT');
            $self->render('mobile/layout.php', new ObjectArray($self->addMeta($data)));
            return ob_get_clean();
        };

          echo $this->evaluateCache("$fileName", $renderFunction);


    }

}
