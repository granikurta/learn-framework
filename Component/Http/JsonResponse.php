<?php


namespace Component\Http;


class JsonResponse extends Response
{

    public function __construct($data = null, int $status = 200, $headers = ['Content-Type: application/json'])
    {
        $jsonData = json_encode($data);
        parent::__construct($jsonData, $status, $headers);
    }
}