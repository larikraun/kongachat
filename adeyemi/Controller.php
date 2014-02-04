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
        session_write_close();
        $messageModel = new MessageModel();
        $messageModel->send($text,$recipient, $sender);
        Util::returnResponse(true);
    }

    public static function receive($user_id, $last_time)
    {
        session_write_close();
        $userModel = new UserModel();
        $activity_time = $userModel->getLastActivityTime($user_id);
        $activity_time_s = strtotime($activity_time);
        $last_time_s = strtotime($last_time);
        $messageModel = new MessageModel();
        if ($activity_time_s == $last_time_s) {
//todo poll and send results
            $time_out = 20;
            while ($time_out > 0) {
                $messages = $messageModel->getMessages($activity_time, $last_time, $user_id);
                sleep(1);
                $time_out--;
                if (count($messages) > 0) {
                    $response = new stdClass();
                    $response->users = $userModel->getUserById($user_id);
                    $current_time = Util::getCurrentDateTime();
                    $response->current_server_time = $current_time;
                    $userModel->updateActivityTime($user_id, $current_time);
                    $response->messages = $messages;
                    Util::returnResponse($response);
                    exit;
                }
            }
            $messages = array();
            $response = new stdClass();
            $response->messages = $messages;
            $response->users = $userModel->getUserById($user_id);
            $current_time = Util::getCurrentDateTime();
            $response->current_server_time = $current_time;
            $userModel->updateActivityTime($user_id, $current_time);
            Util::returnResponse($response);
        } else {
            //get from activity time upwards
            $response = new stdClass();
            $response->messages = $messageModel->getMessagesBelow($last_time, $user_id);

            $response->users = $userModel->getUserById($user_id);
            $current_time = Util::getCurrentDateTime();
            $response->current_server_time = $current_time;
            $userModel->updateActivityTime($user_id, $current_time);
            Util::returnResponse($response);

        }

    }
}

