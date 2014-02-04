<?php
/**
 * Created by PhpStorm.
 * User: Olaoye Adeyemi
 * Date: 2/4/14
 * Time: 9:46 AM
 * To change this template use File | Settings | File Templates.
 */

class UserModel extends BaseModel
{

    public function create($email, $password)
    {
        if (!$this->isExisting($email)) {
            $user_id = $this->add(Users::CREATE, array(strtolower($email), Util::encryptPassword(trim($password))));
            return $user_id;
        } else {
            //todo return is existing
        }
    }

    public function isExisting($email)
    {
        $status = $this->getByParam(Users::IS_EXISTING, $email);
        if ($status == false) {
            return false;
        } else {
            return true;
        }
    }

    public function auth($email, $password)
    {
        $user_id = $this->getByParam(Users::AUTH, array(strtolower($email), Util::encryptPassword($password)));
        if ((int)$user_id > 0) {
            return $user_id[User::$user_id];
        } else {
            return false;
        }
    }

    public function getUserById($user_id)
    {
        return $this->getByParam(Users::GET_BY_ID, $user_id);
    }

    public function updateStatus($user_id, $status)
    {
        $this->execute(Users::UPDATE_STATUS, array($status, $user_id));
    }
} 