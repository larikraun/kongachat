<?php
/**
 * Created by PhpStorm.
 * User: Olaoye Adeyemi
 * Date: 12/9/13
 * Time: 10:44 PM
 * To change this template use File | Settings | File Templates.
 */
session_start();

define("DATA", "data");
define("STATUS", "status");
define("ERROR_MSG", "error_msg");

class Session_Handler
{
    static function addToSessionData($key, $value)
    {
        $_SESSION[DATA][$key] = $value;
    }

    static function unsetSessionData($key)
    {
        unset($_SESSION[DATA][$key]);
    }

    static function setSessionStatus($status, $error_msg = null)
    {
        $_SESSION[STATUS] = $status;
        if ($status) {
            unset($_SESSION[ERROR_MSG]);
        } else {
            $_SESSION[ERROR_MSG] = $error_msg;
        }
    }

    static function clearSessionStatus()
    {
        unset($_SESSION[STATUS]);
        unset($_SESSION[ERROR_MSG]);
    }

    static function clearAllSessionData()
    {
        unset($_SESSION[DATA]);
    }

    static function getSessionStatus()
    {
        if (!isset($_SESSION[STATUS])) {
            $_SESSION[STATUS] = false;
        }
        return $_SESSION[STATUS];

    }

    static function getSessionData($key)
    {
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = null;
        }
        return $_SESSION[$key];

    }


}