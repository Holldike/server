<?php

class Forker
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

    public static function doFork()
    {
		pcntl_fork();
    }
}
