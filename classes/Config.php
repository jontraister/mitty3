<?php

/**
 * Configuration registry.
 *
 * Can addressed using array or object semantics.
 *
 */
class Config extends ReadOnlyArrayObject {

	protected static $env;

	public function __construct() {
		parent::__construct($this->initConfig(), ArrayObject::ARRAY_AS_PROPS );
	}

	protected function initConfig()  {

        $data = Symfony\Component\Yaml\Yaml::parse('data/data.yml');
        $data['debug'] = isset($_SERVER['DEBUG']) && in_array(strtolower($_SERVER['DEBUG']), array('true','yes','on','1'));
        $data=$this->fixCoppa($data);
        $data['routes'] = $this->initRoutes((array) $data['pages']);

        return $data;
	}

    protected function fixCoppa($data)
      {
        if (!isset($data['general']['coppa']) || !$data['general']['coppa'] || 'false' === strtolower($data['general']['coppa']))
            return $data;

        unset($data['pages']['home.html']['feeds']);

        $this->removePage('signup.html', $data);

        $this->removeShareWidgets($data);

        return $data;
    }


    protected function removeShareWidgets(&$data) {
        if (!isset($data['general']['social']))
            return;

        $social=& $data['general']['social'];

        if (!is_array($social))
            return;

        foreach ($social['links'] as & $network) {
            unset($network['share']);
        }
    }


    /**
     * Disables a page from routing and navigation
     *
     * @param string $name
     * @param array $data
     */
    protected function removePage($name, &$data) {

        unset($data['pages'][$name]);

        foreach ($data['general']['navigation'] as $i=>$link) {
            if ($name!=$link['link'])
                continue;
            unset($data['general']['navigation'][$i]);
            break;
        }

    }

    /**
     * Provides route mapping.
     *
     * @param array $pages map of page file names to page data with optional 'route' keys. If the latter are omitted, the default is to add a route matching the page file name. If an 'action' parameter is present, that is used as the page action, otherwise it defaults to 'Page/show'
     * @return array
     * @see Router
     */
	protected function initRoutes($pages) {
            $routes=array();
            $routes['#^/?$#']='UserAgentSwitch/index';

            foreach ( $pages as $template => $page) {
                if (isset($page['route']))
                    $route=$page['route'];
                else
                    $route='#^/?('. preg_replace('/[.]html$/', '', $template) .')\.html$#';

                $routes[$route] = self::getPageAction($page);

            }

            $routes['#(.*)#']='Error/index';

            return $routes;
 	}

    public static function getPageAction($page) {
            if (isset($page['action']))
                return $page['action'];

            return 'Page/show';
    }

    /**
     * Access forbidden!
     *
     * @param string $key
     * @return null
     * @throws Exception
     */
	public function offsetGet($key) {
		if (!$this->offsetExists($key))
			throw new Exception ("Missing key '$key' in Config!");

		return parent::offsetGet($key);
	}

}
