<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Olaoye Adeyemi for Zeko team
 * Date: 7/21/13
 * Time: 7:33 PM
 * To change this template use File | Settings | File Templates.
 */


DEFINE("ERROR_OCCURRED", "An Error Occured!");

/**
 * This class is built on PHP Data Object and it contains functions that allow interaction with a connected database
 * Class DatabaseHandler
 */


class DatabaseHandler
{

    public static $error_message; //Error message
    private $pdo;
    private $dsn = "";
    private $stmt = "";

    /**
     * constructs the DatabaseHandler class
     * @throws PDOException
     *
     */
    function __construct()
    {
        try {
            $this->dsn = "mysql:dbname=" . DBNAME . ";host=" . HOST;
            $this->pdo = new PDO($this->dsn, USERNAME, PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $ex) {
            Util::returnResponse(ERROR_OCCURRED, false);
            Util::logError($ex->getMessage());
        }
    }

    /**
     * Adds to table and returns the last insert id
     * @param $query
     * @param $params
     * @param $sql_params
     * @return string
     *
     */
    public function add($query, $params, $sql_params = array())
    {
        $query = $this->replaceSqlParams($query, $sql_params);
        $this->executeQuery($query, $params);
        return $this->getLastInsertId();
    }

    public function replaceSqlParams($query, $sql_params)
    {

        if (!is_array($sql_params)) {
            $sql_params = array($sql_params);
        }
        if (count($sql_params) == 0) {
            return $query;
        }
        preg_match_all("/[@][a-z|A-Z|_]*/", $query, $placeholders);
        $placeholders = $placeholders[0];
        for ($i = 0; $i < count($placeholders); $i++) {
            $query = str_replace($placeholders[$i], $sql_params[$i], $query);
        }
        return $query;
    }

    /**
     * executes a query
     * @throws PDOException
     */
    public function executeQuery($query, $params = array(), $sql_params = array())
    {
        $query = $this->replaceSqlParams($query, $sql_params);

        try {
            $this->stmt = $this->pdo->prepare($query);
            $placeholders = $this->stripParams($query);
            return $this->stmt->execute($this->makeParamsArray($placeholders, $params));

        } catch (PDOException $ex) {
            Util::returnResponse(ERROR_OCCURRED, false);
            Util::logError($ex->getMessage());
        }
        return false;
    }

    /**
     * get the parameters from the query by searching for words that follow a colon
     * @param $query
     * @return mixed
     */
    private function stripParams($query)
    {
        preg_match_all("/[:][a-z|A-Z|_]*/", $query, $placeholders);

        return $placeholders[0];
    }

    /**
     * Build an associative array of parameters and their values
     * @param $placeholders
     * @param $params
     * @return array
     */
    public function makeParamsArray($placeholders, $params)
    {

        $arr = array();
        // check if $params is an array of parameters
        if (is_array($params)) {
            for ($i = 0; $i < count($params); $i++) {
                $arr[$placeholders[$i]] = $params[$i];
            }
        } else {
            $arr[$placeholders[0]] = $params;
        }
        return $arr;
    }

    /**
     * Get the last insert id
     * @return string
     */
    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * executes a non-query
     * @param $query
     * @param array $params
     * @param array $sql_params
     * @return bool|PDOStatement
     */
    public function executeNonQuery($query, $params = array(), $sql_params = array())
    {
        $query = $this->replaceSqlParams($query, $sql_params);
        try {
            $this->stmt = $this->pdo->prepare($query);
            $placeholders = $this->stripParams($query);
            $this->stmt->execute($this->makeParamsArray($placeholders, $params));
            return $this->stmt;
        } catch (PDOException $ex) {
            Util::returnResponse(ERROR_OCCURRED, false);
            Util::logError($ex->getMessage());
        }
        return false;
    }

    /**
     * fetch a row from the database
     * @param $stmt
     * @param bool $is_assoc
     * @return mixed
     */
    public function fetch($stmt, $is_assoc = true)
    {
        try {
            return $stmt->fetch($is_assoc ? PDO::FETCH_ASSOC : PDO::FETCH_NUM);
        } catch (PDOException $ex) {
            Util::returnResponse(ERROR_OCCURRED, false);
            Util::logError($ex->getMessage());
        }
    }

    /**
     * fetch all matching rows from the database
     * @param $stmt
     * @param bool $is_assoc
     * @return mixed
     */
    public function fetchAll($stmt, $is_assoc = true)
    {
        try {
            return $stmt->fetchAll($is_assoc ? PDO::FETCH_ASSOC : PDO::FETCH_NUM);
        } catch (PDOException $ex) {
            Util::returnResponse(ERROR_OCCURRED, false);
            Util::logError($ex->getMessage());
        }
    }

    /**
     * fetch matching row as an object
     * @param $stmt
     * @param bool $is_assoc
     * @return mixed
     */
    public function fetchObj($stmt, $is_assoc = true)
    {
        try {
            return $stmt->fetchObject($is_assoc ? PDO::FETCH_ASSOC : PDO::FETCH_NUM);
        } catch (PDOException $ex) {
            Util::returnResponse(ERROR_OCCURRED, false);
            Util::logError($ex->getMessage());
        }
    }


}

