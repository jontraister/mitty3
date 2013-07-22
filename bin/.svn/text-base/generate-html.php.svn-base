<?php

require_once(dirname(__FILE__).'/../bootstrap.php');


function apache_request_headers()
{
    return array();
}

function copyRecursive($source, $dest, $exclude = null)
{

    if (null === $exclude)
        $exclude = function($item)
          {
              return true;
          };

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST);

    foreach ($iterator as $item) {
        if ($exclude($item))
            continue;
        if ($item->isDir()) {
            if (!file_exists($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName()))
                mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName(), 0755, true);
        } else {
            echo "copying '$item'\n";
            copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
        }
    }
}

function checkError($reset=false) {
    static $stored=null;

    $error=error_get_last();

    if (!$error)
        return false;

    $last=md5(json_encode($error));

    $check = $stored !== $last;

    if ($reset)
            $stored = $last;

    return $check;


}

if (checkError(true)) {
    echo "Error: ". print_r($x=  error_get_last(), 1);
    die();
}


$_SERVER['DEBUG']='true';
$config = new Config();

$router = new Router($config);
$generator = new SitemapGenerator($config);

$pages = $generator->getAllPagesFlat();

if (!$config['general']['url']) {
        echo "\nPlease specify a site url in data.yml: general->url\n";
        die();
}


$dir = 'static';
if (!is_dir($dir))
    mkdir ($dir);

$log='';
foreach ($pages as $page) {
    $rendered[] = $path = '/'. $page['url'];
    $log .= "rendering '{$path}'\n";
    ob_start();
    $router->route($path);
    $html = ob_get_clean();
    file_put_contents($dir . $path, $html);

    if (checkError()) {
        echo "$log\nError: ". print_r($x=  error_get_last(), 1);
        die();
    }
}
echo $log;

copyRecursive('web', 'static', function ($item) { return preg_match('#(^\.|/\.|\.php$)#', $item->getPathName());});

