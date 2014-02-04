<?php

class UserController
{

    public static function signup($email, $password, $c_password)
    {
        $userModel = new UserModel();
        $password = trim($password);
        $c_password = trim($c_password);
        $email = strtolower($email);
        if ($c_password == $password) {
            $userModel->create($email, $password);
            UserController::auth($email, $password);
        } else {
            Util::returnResponse("Passwords don't match", false);
        }
    }

    public static function auth($email, $password)
    {
        $userModel = new UserModel();
        $auth = $userModel->auth($email, $password);
        $response = new stdClass();
        if ($auth != false) {
            $userModel->updateStatus($auth, true);
            $response->user = $userModel->getUserById($auth);
            Util::returnResponse($response);
        } else {
            Util::returnResponse("Invalid Username or Password", false);
        }

    }
}

class MessageController
{



}

