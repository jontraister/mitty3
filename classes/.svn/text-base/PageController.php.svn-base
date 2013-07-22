<?php

/**
 * Renders page content into 'layout.php' wrapper.
 */
class PageController extends TemplateController
{

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
        $this->setHeaders();

        $args = func_get_args();
        array_shift($args);

        $fileName = $templateName . '.html';

        $self = $this;

        $renderFunction = function () use ($fileName, $args, $self)
          {
            ob_start();
              $data = (array) $self->config['general'];

              $data['content'] = array(
                  'file' => $self->getFile($fileName),
                  'vars' => $self->getContentVars($fileName, $args)
              );

              header('X-Server-Cached: no');
              $self->render('layout.php', new ObjectArray($self->addMeta($data)));

              return ob_get_clean();
          };

          echo $this->evaluateCache("$fileName-" . join('-', $args), $renderFunction);
    }

    public function getPages($fileName) {

        $content=$this->getContentVars($fileName, array());

        $title = isset($content['title'])?$content['title']:'';

        return array( array( 'url' => $fileName, 'title' => $title ));
    }

    protected function evaluateCache($key, $renderFunction) {
        echo $this->getCache()->evaluate($key, $renderFunction, 600);
    }

    /**
     * Get page cache.
     *
     * return Cache
     */
    private function getCache() {
        if ($this->config->debug)
            $cache=new Cache ();
        else
            $cache = MemcacheCache::createFromSession();
        return $cache->prefix(__CLASS__ . '-');
    }

    protected function setHeaders()
    {
        if ($this->config->debug)
            return;

        $maxAge = 300;

        $headers = apache_request_headers();

        if (isset($headers['If-Modified-Since']) && strtotime($headers['If-Modified-Since']) < time() - $maxAge) {
            header('HTTP/1.1 304 Not Modified');
            exit;
        }

        header('Expires: ' . gmdate('D, d M Y H:i:s ', time() + 3600 * 6) . 'GMT'); // expire after 6 hours on the client
        header('Cache-Control: s-maxage = ' . $maxAge); // expire within $maxAge on the CDN
    }

    protected function getContentVars($fileName, $args)
    {
        return (array) $this->config['pages'][$fileName];
    }

    /**
     * Get page content data.
     *
     * @return array
     */
    protected function addMeta($data)
    {
        if (!isset($data['url']) || empty($data['url']))
          $data['url'] = 'http://' . $_SERVER['SERVER_NAME'] . '/';

        $this->addContentMeta($data);

        $this->def($data['og']['title'], $data['meta']['title']);
        $this->def($data['og']['description'], $data['meta']['description']);
        $this->def($data['og']['site_name'], $data['og']['title']);


        return $data;
    }

    protected function addContentMeta(&$data)
    {
        $contentVars = $data['content']['vars'];

        foreach (array('meta', 'og') as $meta)
            if (isset($contentVars[$meta]) && is_array($contentVars[$meta]))
                foreach ($contentVars[$meta] as $key => $value) {
                    if ('title'!=$key)
                        $data[$meta][$key] = $value;
                    else
                        $data[$meta][$key] = $data[$meta][$key] .' | '. $value;
                }
    }

    protected function def(&$var, $default)
    {
        if (!isset($var) || empty($var))
           $var = $default;

    }

}
