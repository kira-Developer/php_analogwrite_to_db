<?php
require __DIR__ . "/inc/bootstrap.php";
 
if (!file_exists("number.sqlite")) {require_once PROJECT_ROOT_PATH . "/inc/bulidDatabase.php";}
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
 
if ((isset($uri[2]) && $uri[2] != 'numbers') || !isset($uri[3])) {
    header("Location: http://localhost:8080/404.php");          

    exit();
}
 
require PROJECT_ROOT_PATH . "/Controller/Api/NumberController.php";
$requestMethod = $_SERVER["REQUEST_METHOD"];

$objFeedController = new NumberController();
try{
    $strMethodName = $uri[3] . 'Action';
    if ($uri[3] == "post" && $requestMethod == "POST") :
        $objFeedController->post();
    endif;
    $objFeedController->{$strMethodName}();
}catch( Exception $e) {

}

?>
