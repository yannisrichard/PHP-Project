<?php

namespace Http;

class Request
{
    const GET    = 'GET';

    const POST   = 'POST';

    const PUT    = 'PUT';

    const DELETE = 'DELETE';

    private $parameters = array();

    private $negotiator = null;

    public function __construct(array $query = array(), array $request = array())
    {
        $this->negotiator = new \Negotiation\FormatNegotiator();
        $this->parameters = array_merge($query, $request);
    }

    public function getParameter($name, $default = null)
    {
        if (array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        }

        return $default;

    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public static function createFromGlobals()
    {

        if((isset($_SERVER['CONTENT_TYPE']) &&  $_SERVER['CONTENT_TYPE']==='application/json')
                ||(isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE']==='application/json')) {
            $data    = file_get_contents('php://input');
            $request = @json_decode($data, true);

            return new self($_GET, $request);
        } else

            return new self($_GET, $_POST);
    }

    public function getMethod()
    {

        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::GET;

        if (self::POST === $method) {
            return $this->getParameter('_method', $method);
        }

        return $method;
    }

    public function getURI()
    {
        $uri    = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        if ($pos = strpos($uri, '?')) {
                $uri = substr($uri, 0, $pos);
        }

        return $uri;
    }

    public function guessBestFormat()
    {
        $acceptHeader = $_SERVER['HTTP_ACCEPT'];
        $priorities   = array('html', 'application/json', '*/*');
        $format = $this->negotiator->getBestFormat($acceptHeader, $priorities);

        //echo "</br>Format: ".$format;
        return $format;
    }
}
