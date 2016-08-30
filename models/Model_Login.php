<?php

/**
 * Created by PhpStorm.
 * User: Eleonora
 * Date: 30.08.2016
 * Time: 23:25
 */
require_once '/core/Model.php';

class Model_Login extends Model
{
    const HOST = "127.0.0.1";
    const DB_NAME = "users";
    const DB_USER = "mg"; // Change user and password to yours to get it works
    const DB_PASSWORD = "meangirls";

    private $pdo;

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

    public function getUserInfoByEmailPassword($email, $password)
    {
        $stmt = $this->getPDO()->prepare('SELECT id, last_visit, password FROM user WHERE email = ?');
        $stmt->execute(array($email));
        while ($row = $stmt->fetch()) {
            if (isset($row['password']) && $this->passwordsAreEqual($password, $row['password'])) {
                return $row;
            }
        }
        return null;
    }

    public function updateLastVisitForId($id)
    {
        $now = date("Y-m-d H:i:s");
        $sql = "UPDATE user SET last_visit = ? WHERE id = ?";
        $stm = $this->getPDO()->prepare($sql);
        $stm->execute(array($now, $id));
        return true;
    }

    private function passwordsAreEqual($userPassword, $dbPassword)
    {
        $salt = 'zinit'; // this string is used for safety, salt is adding while writing password to db

        return md5($salt . $userPassword) === $dbPassword;
    }


}