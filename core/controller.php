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
    
    function action_index()
    {
        // todo
    }
}
