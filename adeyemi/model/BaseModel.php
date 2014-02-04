<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Olaoye Adeyemi for Zeko team
 * Date: 7/29/13
 * Time: 11:47 AM
 * To change this template use File | Settings | File Templates.
 */


class BaseModel
{

    /**
     * execute a query that (returns true or false)
     * @param $query
     * @param $params
     * @param $sql_params
     * @return bool
     */
    public function execute($query, $params, $sql_params = array())
    {
        $db_handler = new DatabaseHandler();
        return $db_handler->executeQuery($query, $params, $sql_params);
    }

    /**
     * Add to a table and get last insert id
     * @param $query
     * @param $params
     * @param $sql_params
     * @return string
     */
    public function add($query, $params, $sql_params = array())
    {
        $db_handler = new DatabaseHandler();
        return $db_handler->add($query, $params, $sql_params);
    }

    /**
     * Get a row from the database matching the query
     * @param $query
     * @param $param
     * @param $sql_params
     * @return mixed
     */
    public function getByParam($query, $param = array(), $sql_params = array())
    {
        $db_handler = new DatabaseHandler();
        $stmt = $db_handler->executeNonQuery($query, $param, $sql_params);
        return $db_handler->fetch($stmt, true);
    }

    /**
     * Get all rows from the database matching the query
     * @param $query
     * @param $param
     * @param $sql_params
     * @return array|mixed
     */
    public function getAllByParam($query, $param = array(), $sql_params = array())
    {
        $db_handler = new DatabaseHandler();
        $stmt = $db_handler->executeNonQuery($query, $param, $sql_params);
        $result = $db_handler->fetchAll($stmt, true);
        return ($result != false) ? $result : array();
    }


}