<?php

class UserReposiroty
{
    public function getUser($userName, $password)
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':username' => $userName,
            ':password' => $password
        ]);
        $row = $stmt->fetchObject();
        if (empty($row)) {
            $user = null;
        } else {
            $user = new User();
            $user->setUserID($row->userID);
            $user->setName($row->name);
            $user->setUserName($row->username);
            $user->setPassword($row->password);
        }
        return $user;
    }
}
