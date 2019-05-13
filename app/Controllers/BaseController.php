<?php

namespace Miciew\Controllers;

use Miciew\Views\View;

class BaseController
{
    protected $view = null;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function render($template, $data = array())
    {
        foreach ($data as $key => $value){
            $this->view->$key = $value;
        }

        $this->view->render($template);
    }

    public function redirect($path, $status = 302, $code = true)
    {
        header("Location: {$path}", $code, $status);
        exit();
    }
}