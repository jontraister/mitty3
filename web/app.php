<?php

require_once('../bootstrap.php');
 
$router=new Router(new Config()); 
$router->route(); 

