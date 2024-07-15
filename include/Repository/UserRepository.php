<?php

class UserReposiroty
{
    public function getUserbyID ($userID)
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT * FROM users WHERE userID = :userID";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':userID' => $userID]);
        $row = $stmt->fetchObject();
        $user = new User();
        $user->setUserID($row->userID);
        $user->setName($row->name);
        $user->setUserName($row->username);
        $user->setPassword($row->password);
    }
}