<?php

namespace Controller\Admin;

class GenreController extends AdminController
{
    public function view()
    {
        $GenreRepo = new \GenreRepository();
        $genres = $GenreRepo->getAll();

        require_once '../template/admin/genre.phtml';
    }

    public function add()
    {
        if (isset($_POST['submit']) && isset($_POST['genre'])) {
            $genre = new \Genre();
            $genre->setName($_POST['genre']);
            $GenreRepo = new \GenreRepository();
            $GenreRepo->insert($genre);
            $name = $genre->getName();
            header("location: index.php?controller=admin.genre&action=view&add=$name");
        }

        include '..\template\admin\genre\add_genre.phtml';
    }

    public function edit()
    {
        $genreRepo = new \GenreRepository();
        if (isset($_GET["genreID"])) {
            $genreID = $_GET["genreID"];
            $genre = $genreRepo->getById($genreID);
            if (isset($_POST["submit"]) && isset($_POST["name"])) {
                $genre->setName($_POST["name"]);
                $genreRepo->update($genre);
                $name = $genre->getName();
                header("location: index.php?controller=admin.genre&action=view&edit=$name");
            }
            require_once '..\template\admin\genre\update_genre.phtml';
        } else {
            echo "error";
        }
    }

    public function delete()
    {
        if (isset($_GET["genreID"])) {

            if (isset($_POST["submit"])) {
                $GenreRepo = new \GenreRepository();
                $genre = $GenreRepo->getById($_GET["genreID"]);
                $genreName = $genre->getName();
                if ($_POST["submit"] == 1) {
                    $GenreRepo->delete($genre);
                    header("location: index.php?controller=admin.genre&action=view&del=$genreName");
                    exit;
                } elseif ($_POST["submit"] == 0) {
                    header("location: index.php?controller=admin.genre&action=view&err=$genreName");
                    exit;
                }
            }
        } else {
            header("index.php?controller=admin.genre&action=view");
            exit;
        }
        
        require_once '..\template\admin\genre\delete_genre.phtml';
        
    }
}
