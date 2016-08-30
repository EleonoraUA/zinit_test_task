<?php

class Controller_Login extends Controller
{

	function __construct()
	{
		//$this->model = new Model_login();
		$this->view = new View();
	}
	
	function action_index()
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

		if ($this->isValidEmail($email) && $this->isValidPassword($password)) {
			echo json_encode(array('status' => true));
			// TODO safe to database
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
