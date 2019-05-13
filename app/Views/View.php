<?php

namespace Miciew\Views;


use Miciew\Configs\Config;

class View
{
    protected $_property = array();

    public function __set($name, $value)
    {
        $this->_property[$name] = $value;
    }
    public function __get($name)
    {
        return $this->_property[$name];
    }
    public function __isset($name)
    {
        return isset($this->_property[$name]);
    }

    public function render($template)
    {
        $templatesDir = Config::getInstance()->getConfigs()['templates'];

        ob_start();
        require  $templatesDir . "/$template.php";
        $content = ob_get_clean();

        include_once $templatesDir . '/layout.php';
    }
}