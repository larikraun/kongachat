<?php
/**
 * Created by PhpStorm.
 * User: Olaoye Adeyemi
 * Date: 1/24/14
 * Time: 6:36 PM
 * To change this template use File | Settings | File Templates.
 */
require "./config/init.php";
if (isset($_SERVER["HTTP_REFERER"])) {
    DEFINE("REFERER", $_SERVER["HTTP_REFERER"]);
} else {
    DEFINE("REFERER", "../../");
}

$httpReq = new HttpRequestHandler();
$action = $httpReq->getAction();
if (count($_POST) > 0) {
    $params = $httpReq->getPostParameters();
    HttpRequestHandler::$is_post = true;
} else if (count($_GET) > 0) {
    $params = $httpReq->getGetParameters();
    HttpRequestHandler::$is_get = true;
};
HttpRequestHandler::$params = $params;


$controller = $httpReq->getController();
$controller = $controller . "Controller";
$method = $httpReq->getAction();
try {
    $reflection_class = new ReflectionClass($controller);
    $method = $reflection_class->getMethod($action);
    $parameters = $method->getParameters();
    $params = (array)$params;
    $args = array();
    $arg_list = getArgList($parameters);
    $error_list = array();
    if (paramsCheck($parameters, $params, $error_list)) {
        $reflection_class->getMethod($action)->invokeArgs(new $controller(), stripArgs($params, $arg_list));
    } else {

        if (HttpRequestHandler::$is_post) {
            Session_Handler::setSessionStatus(false, generateAbsentParamsMessage($error_list));
            Session_Handler::addToSessionData('form_post', HttpRequestHandler::$params);
            header("location:" . REFERER);
        } else {
            Util::returnResponse(generateAbsentParamsMessage($error_list), false);
        }

    }
} catch (ReflectionException $ex) {
    echo $ex->getMessage();
    exit;
}

function paramsCheck($methodParameters, $params, &$invalid_list)
{
    $count = 0;
    $args_list = getArgList($methodParameters);
    for ($j = 0; $j < count($args_list); $j++) {
        $parameter = $methodParameters[$j];
        if (!array_key_exists($args_list[$j], $params) && !$parameter->isDefaultValueAvailable()) {
            $invalid_list[$count] = $args_list[$j];
            $count++;
        }
    }
    return count($invalid_list) == 0;
}

function stripArgs($params, $args_list)
{
    $args = array();

    for ($i = 0; $i < count($args_list); $i++) {
        if (isset($params[$args_list[$i]])) {
            $args[$i] = $params[$args_list[$i]];
        }
    }
    return $args;
}

function getArgList($parameters)
{
    $args_list = array();
    for ($i = 0; $i < count($parameters); $i++) {
        $parameter = $parameters[$i];
        $args_list[$i] = $parameter->getName();
    }
    return $args_list;
}

function generateAbsentParamsMessage($absent_params)
{
    $message = "";
    $length = count($absent_params);
    for ($i = 0; $i < $length; $i++) {
        if ($length == 1) {
            $message = $message . $absent_params[$i];
        } else if ($i == $length - 2) {
            $message = $message . $absent_params[$i] . " and ";
        } else if ($i != $length - 1) {
            $message = $message . $absent_params[$i] . ", ";
        } else {
            $message = $message . $absent_params[$i];
        }

    }

    return "$message required";
//    return "Invalid Parameters!";
}