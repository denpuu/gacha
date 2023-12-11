<?php

namespace controller;

abstract class BaseController
{
    private $response = [];

    public function GetRequestParam($key) {
        if (array_key_exists($key, $_POST)) {
            return $_POST[$key];
        }
        if (array_key_exists($key, $_GET)) {
            return $_GET[$key];
        }
        if (($val = $this->GetCliArg($key)) !== null) {
            return $val;
        }
        return null;
    }

    private function GetCliArg($key)
    {
        $arg = getopt('', [$key . '::']);
        if (array_key_exists($key, $arg)) {
            return $arg[$key];
        }
        return null;
    }

    public function addResponse(...$responses) {
        foreach($responses as $response) {
            array_push($this->response, $response);
        }
    }

    public function getResponse() {
        if(php_sapi_name() === 'cli') {
            return implode(PHP_EOL, $this->response);
        } else {
            return implode('</br>' . PHP_EOL, $this->response);
        }
    }
}