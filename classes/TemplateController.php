<?php

/**
 * Renders templates.
 */
class TemplateController extends Controller
{

    protected function render($name, $vars = array())
    {
        $file = $this->getFile($name);

        if (!$file)
            $file = $this->getFile('error.html');

        if (!$file)
            return;

        $template = new Template($file, $vars, $this->request);
        $template->render();
    }

    protected function getFile($name)
    {
        if (!preg_match('#[A-Za-z0-9_-]+\.(php|phtml|html)#i',$name))
            return $this->fail("Invalid file name '" . htmlentities($name) . "'");

        $file = 'templates/' . $name;

        if (!file_exists($file))
            return $this->fail("File does not exists '" . htmlentities($file) . "'");

        return $file;
    }

    private function fail($message)
    {
        if ($this->config->debug)
            throw new Exception($message);

        return false;
    }

}
