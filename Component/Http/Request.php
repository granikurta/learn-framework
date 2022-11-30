<?php


namespace Component\Http;


class Request
{

    protected $method;

    /**
     * @var ParameterBag
     */
    public $query;

    /**
     * @var ParameterBag
     */
    public $request;

    /**
     * @var ParameterBag
     */
    public $server;

    public function __construct(array $query = [], array $request = [], array $server = [])
    {
        $this->query = new ParameterBag($query);
        $this->request = new ParameterBag($request);
        $this->server = new ParameterBag($server);
    }

    /**
     * @return static
     */
    public static function createFromGlobals()
    {
        return new static($_GET, $_POST, $_SERVER);
    }

    public function getMethod(): string
    {
        if (null !== $this->method) {
            return $this->method;
        }

        $method = $this->server->get('REQUEST_METHOD', 'GET');
        return $this->method = $method;
    }

    /**
     * @param string $method
     * @return void
     */
    public function setMethod(string $method): void
    {
        $this->method = null;
        $this->server->set('REQUEST_METHOD', $method);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return parse_url($this->server->get('REQUEST_URI'), PHP_URL_PATH);
    }

}