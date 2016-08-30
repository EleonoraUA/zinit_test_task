<?php

class Controller_Login extends Controller
{

    const HOST = "127.0.0.1";
    const DB_NAME = "users";
    const DB_USER = "mg"; // Change user and password to yours to get it works
    const DB_PASSWORD = "meangirls";

    private $pdo;

	function __construct()
	{
		$this->view = new View();
	}

    private function getPDO()
    {
        if (!isset($this->pdo)) {
            $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";";
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );
            $this->pdo = new PDO($dsn, self::DB_USER, self::DB_PASSWORD, $opt);
        }
        return $this->pdo;
    }

    function action_index()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($this->isValidEmail($email) && $this->isValidPassword($password)) {
            $stmt = $this->getPDO()->prepare('SELECT id, last_visit, password FROM user WHERE email = ?');
            $stmt->execute(array($email));
            while ($row = $stmt->fetch()) {
                if (isset($row['password']) && $this->passwordsAreEqual($password, $row['password'])) {
                    echo json_encode(array('status' => true, 'id' => $row['id'], 'last_visit' => $row['last_visit']));
                    $now = date("Y-m-d H:i:s");
                    $sql = "UPDATE user SET last_visit = ? WHERE id = ?";
                    $stm = $this->getPDO()->prepare($sql);
                    $stm->execute(array($now, $row['id']));

                }
            }
        } else {
            echo json_encode(array('status' => false));
        }
    }

    private function passwordsAreEqual($userPassword, $dbPassword)
    {
        $salt = 'zinit'; // this string is used for safety, salt is adding while writing password to db

        return md5($salt . $userPassword) === $dbPassword;
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
