<?php

namespace Miciew\Configs;


class Config
{
    protected static $instance = null;

    protected $configs = [];

    protected function __construct()
    {
        $this->configs = require 'configs.php';
    }

    public function getConfigs()
    {
        return $this->configs;
    }

    /**
     * @return Config|null
     */
    public static function getInstance()
    {
        if ( is_null(static::$instance) )
        {
            static::$instance = new static();
        }
        return static::$instance;
    }
}