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
            if (strlen($password) > 0) {
                if (strlen($email) > 0) {
                    $userModel->create($email, $password);
                    UserController::auth($email, $password);
                } else {
                    Util::returnResponse("Please enter a valid email", false);
                }
            } else {
                Util::returnResponse("Please enter a valid password", false);
            }

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
            $response->users = $userModel->getUsers($auth);
            $response->current_server_time = Util::getCurrentDateTime();
            Util::returnResponse($response);
        } else {
            Util::returnResponse("Invalid Username or Password", false);
        }

    }
}

class MessageController
{
    public static function send($text, $sender, $recipient)
    {
        $messageModel = new MessageModel();
        $messageModel->send($text, $sender, $recipient);
        Util::returnResponse(true);
    }

    public static function receive($user_id, $last_time)
    {
        $userModel = new UserModel();
        $activity_time = $userModel->getLastActivityTime($user_id);
        $activity_time_s = strtotime($activity_time);
        $last_time_s = strtotime($last_time);
        $messageModel = new MessageModel();
        if ($activity_time_s == $last_time_s) {
//todo poll and send results

        } else {
            //get from activity time upwards
            $response = new stdClass();
            $response->messages = $messageModel->getMessagesBelow($last_time, $user_id);
            $userModel->updateActivityTime();
            $response->current_server_time = Util::getCurrentDateTime();
            Util::returnResponse($response);
        }

    }
}

