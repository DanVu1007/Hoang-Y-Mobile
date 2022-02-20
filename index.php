<?php
	
	require_once 'define.php';

    spl_autoload_register('myautoload');
    function myautoload($className){
        require_once LIBRARY_PATH."{$className}.php";
    } 
    
    Session::init();
	$bootstrap = new Bootstrap();
	$bootstrap->init(); 