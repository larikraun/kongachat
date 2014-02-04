<?php
/**
 * Created by PhpStorm.
 * User: MICROSOFt
 * Date: 1/22/14
 * Time: 12:32 AM
 */


class Users
{
    const CREATE = "INSERT INTO users(email, password) VALUES(:email, :password)";
    const AUTH = "SELECT user_id FROM users WHERE email = :email AND password = :password";
    const UPDATE_STATUS = "UPDATE users SET status = :status  WHERE user_id = :user_id";
    const IS_EXISTING = "SELECT email FROM users WHERE email = :email";
    const GET_BY_ID = "SELECT email, user_id, status FROM users WHERE user_id = :user_id";


}

class Messages
{

}