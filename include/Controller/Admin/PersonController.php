<?php

namespace App\Controller\Admin;

use App\Model\Person;
use App\Repository\PersonRepository;

class PersonController extends AdminController
{
    public function view()
    {
        $PersonRepo = new PersonRepository();
        $people = $PersonRepo->getAll();

        require_once '../template/admin/person.phtml';
    }

    public function add()
    {
        if (
            isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['gender'])
            && isset($_POST['birthday']) && isset($_POST['role'])
        ) {
            $person = new Person();
            $person->setName($_POST['name']);
            $person->setGender($_POST['gender']);
            $person->setBirthday($_POST['birthday']);
            $person->setRole($_POST['role']);
            $personRepo = new PersonRepository();
            $personRepo->insert($person);
            $name = $person->getName();
            header("location: index.php?controller=admin.person&action=view&add=$name");
        }
        require_once '..\template\admin\people\add_person.phtml';
    }

    public function edit()
    {
        if (isset($_GET["personID"])) {
            $personID = $_GET["personID"];
            $personRepo = new PersonRepository();
            $person = $personRepo->getPersonById($personID);
            if (
                isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['gender'])
                && isset($_POST['birthday']) && isset($_POST['role'])
            ) {
                $person->setName($_POST['name']);
                $person->setGender($_POST['gender']);
                $person->setBirthday($_POST['birthday']);
                $person->setRole($_POST['role']);
                
                $personRepo->update($person);
                $name = $person->getName();
                header("location: index.php?controller=admin.person&action=view&del=$name");
            } elseif (isset($_POST['submit'])){
                echo "You have to fill all information";
            }
        } else {
            header("location: index.php?controller=admin.person&action=view&err=0");
        }
        
        
        
        require_once '..\template\admin\people\update_person.phtml';
    }

    public function delete()
    {
        if (isset($_POST["rep"])) {
            if (isset($_GET["personID"]) && $_POST["rep"] == 1) {
        
                $PersonRepo = new PersonRepository();
                $person = $PersonRepo->getPersonById($_GET['personID']);
                $name = $person->getName();
                $PersonRepo->delete($person);
                header("location: index.php?controller=admin.person&action=view&del=$name");
                exit;
            } else {
                header("location: index.php?controller=admin.person&action=view&err=1");
                exit;
            }
        }
        
        require_once '..\template\admin\people\delete_person.phtml';
    }
}
