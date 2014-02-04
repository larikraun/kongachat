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
    const GET_LAST_ACTIVITY_TIME = "SELECT last_activity_time FROM users WHERE user_id = :user_id";
    const GET_USERS = "SELECT email, user_id, status FROM users WHERE user_id != :user_id";

//    const UPDATE_ACTIVITY_TIME = "UPDATE "


}

class Messages
{
    const SEND = "INSERT INTO message(text, recipient, sender) VALUES(:text, :recipient, :sender)";
    const GET_MESSAGES_BELOW = "SELECT text, sender FROM message WHERE recipient = :recipient AND date(date_time) <= :date_time";


}