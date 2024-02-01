<?php
error_reporting(E_ALL & ~E_NOTICE);

session_start();
// print_r($_SESSION);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// define('PATH_DIR', 'http://localhost:8888/stampee/'); //mac
// define('PATH_DIR', 'http://localhost:8000/stampee/'); //windows
define('PATH_DIR', 'https://e2296789.webdev.cmaisonneuve.qc.ca/stampee/'); //webdev

require_once('controller/Controller.php');
require_once('library/RequirePage.php');
require_once __DIR__.'/vendor/autoload.php';
require_once('library/Twig.php');
require_once('library/CheckSession.php');

// $url = isset($_SERVER['PATH_INFO'])? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/'; //localhost
$url = isset($_GET["url"]) ? explode ('/', ltrim($_GET["url"], '/')) : '/';  //webdev

// print_r($url);
// echo $url[0]; // controller
// echo $url[1]; // method
// echo $url[2]; // value

if($url == '/'){
    require_once('controller/ControllerHome.php');
    $controller = new ControllerHome;
    echo $controller->index(); 
}else{
    $requestURL = $url[0];
    $requestURL = ucfirst($requestURL);
    $controllerPath = __DIR__."/controller/Controller".$requestURL.".php";

    if(file_exists($controllerPath)){
        require_once( $controllerPath);
        $controllerName = 'Controller'.$requestURL;
        $controller = new $controllerName;
        if(isset($url[1])){
            $method = $url[1];
            if(isset($url[2])){
                echo $controller->$method($url[2]);
            }else{
                echo $controller->$method();
            }
        }else{
            echo $controller->index();
        }
    }else{
        // require_once('controller/ControllerHome.php');
        // $controller = new ControllerHome;
        // echo $controller->error('404'); 
        return $controller->errorInfo();
    }
}
?>
