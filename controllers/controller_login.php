<?php

/**
 * Created by PhpStorm.
 * User: Eleonora
 * Date: 30.08.2016
 * Time: 13:18
 */
require_once '../models/Model_Login.php';

class Controller_Login extends Controller
{

	function __construct()
	{
		$this->view = new View();
        $this->model = new Model_Login();
	}

    function action_index()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($this->isValidEmail($email) && $this->isValidPassword($password)) {
            $userInfo = $this->model->getUserInfoByEmailPassword($email, $password);
            if ($userInfo != null) {
                $this->model->updateLastVisitForId($userInfo['id']);
                echo json_encode(array('status' => true, 'id' => $userInfo['id'], 'last_visit' => $userInfo['last_visit']));
            }
        } else {
            echo json_encode(array('status' => false));
        }
    }

    private function isValidEmail($email)
    {
        return preg_match('/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email);
    }

    private function  isValidPassword($password)
    {
        return preg_match('/^[a-zA-Z\d]+$/', $password);
    }
}
