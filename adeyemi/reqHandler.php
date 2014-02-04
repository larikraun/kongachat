<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Boyewa
 * Date: 9/3/13
 * Time: 5:52 AM
 * To change this template use File | Settings | File Templates.
 */

class HttpRequestHandler
{

    public static $params;
    public static $is_get;
    public static $is_post;
    private $request;
    private $controller;
    private $action;
    private $parameter;

    public function __construct()
    {
        if (isset($_REQUEST)) {
            $request = $_REQUEST;

            if ($request) {
                $this->request = $request;

                $this->requestProcessor();
            }
        }
    }

    private function requestProcessor()
    {
        if ($this->request) {
            if (isset($this->request[HttpReqParams::controller])) {
                $this->controller = array_shift($this->request);
            }
            if (isset($this->request[HttpReqParams::action])) {
                $this->action = array_shift($this->request);
            }

            $this->parameter = (object)$this->request;
        }
    }

    public static function blockGet($redirect_url)
    {
        if (HttpRequestHandler::$is_get) {
            header("location:$redirect_url");
            exit();
        }
    }

    public function getParameter()
    {
        return $this->parameter;
    }

    public function getPostParameters()
    {
        return (object)$_POST;
    }

    public function getGetParameters()
    {
        return (object)$_GET;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getValidControllers()
    {
        return $this->validControllers;
    }

    public function isValidRequest()
    {
        return ($this->getAction() != NULL) && ($this->getController() != NULL)
        && (strlen($this->getAction()) > 0)
        && (strlen($this->getController()) > 0);
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function createRequest()
    {

    }
}

class HttpResponseHandler extends ResponseObj
{

    private $headerBuffer = "";
    private $response;

    public function __construct()
    {
        $this->headerBuffer = "";

    }

    public function setResponseHeader($header_type, $header_value)
    {
        $this->headerBuffer .= $header_type . ":" . $header_value;
    }
}

class ResponseObj
{
    private $status;
    private $header;
    private $payload;

    public function __construct()
    {

    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getResponse()
    {
        return $this;
    }
}

class HttpReqParams
{
    const controller = 'controller';
    const action = 'action';
    const params = 'params';
}


