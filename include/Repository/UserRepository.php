<?php

class UserRepository
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

    public function getAll()
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT * FROM users";
        $stmt = $pdo->query($query);
        $row = $stmt->fetchObject();

        if (empty($row)) {
            $users = null;
        } else {
            $users = [];
            while ($row = $stmt->fetchObject()) {
                $user = new User();
                $user->setUserID($row->userID);
                $user->setName($row->name);
                $user->setUserName($row->username);
                $user->setPassword($row->password);
                $users[] = $user;
            }
        }
        return $users;
    }

    public function getUserByID($userID)
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
        return $user;
    }

    public function delete(User $user)
    {
        $pdo = MyPDO::getInstance();
        $query = "DELETE FROM users WHERE userID = :userID";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':userID'=>$user->getUserID()]);
    }
}
