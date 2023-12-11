<?php

class Autoloader
{
    private $root = null;
    public function __construct($root) {
        $this->root = $root;
    }

    public function load() {
        spl_autoload_register([$this, 'read']);
    }

    private function read($class) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = $this->root . $class . '.php';

        if (is_readable($file)) {
            require_once $file;
        }
    }
}