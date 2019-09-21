<?php

class HttpResponseBuilder
{
    private $code;

    private $body;

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function build()
    {

    }
}
return
    "HTTP/1.1 200 OK\n
    <h1 style='text-align: center'>HOLLDIKE SERVER</h1>";
