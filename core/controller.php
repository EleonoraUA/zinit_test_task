<?php

/**
 * Created by PhpStorm.
 * User: eleonoria
 * Date: 8/30/16
 * Time: 1:18 PM
 */
class Controller
{

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    // действие (action), вызываемое по умолчанию
    function action_index()
    {
        // todo
    }
}
