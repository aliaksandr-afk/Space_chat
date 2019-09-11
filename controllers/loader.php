<?php
//точка первой обработки

error_reporting(E_ALL);       // устанавливает уровень отслеживаемых ошибок интерпретатором php
ini_set('display_errors', 1); // дает команду интерпретатору php выводить все отслеживаемые ошибки в браузере

require_once __DIR__ . '/../models/modelconfig.php';
require_once __DIR__ . '/../models/modelmessages.php';

$model = new modelmessages();
$post = $_POST;
$get = $_GET;

if (isset($post['ajax']) && $post['ajax'] == true){
    if($post['action'] == 'get'){
            require_once __DIR__ . '/../controllers/ajaxgetmessages.php';
    }
    if($post['action'] == 'add'){
            require_once __DIR__ . '/../controllers/ajaxadd.php';
    }
    if($post['action'] == 'delete'){
            require_once __DIR__ . '/../controllers/ajaxdelete.php';
    }
    exit;
}

if (isset($get['logout']) && $get['logout'] == true){
    $model->logout();
    header("Location: index.php");
    exit;
}

$gotoLoginPage = isset($get['loginpage']) && $get['loginpage'] == true ||
    isset($post['pagename']) && $post['pagename'] == 'login';


if ($gotoLoginPage == true) {
    require_once __DIR__ . '/../controllers/controllerregistration.php';
} else {
    require_once __DIR__ . '/../controllers/controllerchat.php';
}