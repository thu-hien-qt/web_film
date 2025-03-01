<?php

namespace App\Controller\Admin;

use App\Repository;

class FilmController extends AdminController
{
    public function viewDetail() {

    }

    public function edit() {
        $GenreRepo = new \App\Repository\GenreRepository;
        $genres = $GenreRepo->getAll();
        
        $getFilm = new \App\Repository\FilmRepository();
        $films = $getFilm->getAll();
        
        $PersonRepo = new \App\Repository\PersonRepository();
        $actors = $PersonRepo->getActors();
        $directors = $PersonRepo->getDirectors();
        
        if (isset($_GET["id"])) {
            $filmID = $_GET["id"];
            $FilmRepo = new \App\Repository\FilmRepository();
            $film = $FilmRepo->getByFilmID($filmID);
        }
        
        $error = "";
        
        if (isset($_POST["update"])) {
            if (
                empty($_POST["title"]) || empty($_POST["manufacture"]) || empty($_POST["link"])
                || empty($_POST["img"]) || empty($_POST["description"]) || empty($_POST["director"])
                || empty($_POST["actors"]) || empty($_POST["genres"])
            ) { 
                $error = "Please complete all information.";
            } else {
        
                $film->setTitle($film->getTitle());
                $film->setManufacture($_POST["manufacture"]);
                $film->setLink($_POST["link"]);
                $film->setImg($_POST["img"]);
                $film->setDescription($_POST["description"]);
                $film->removeDirector();
                $director = $PersonRepo->getPersonById($_POST["director"]);
                $film->addDirector($director);
        
                $film->removeAllActor();
                foreach ($_POST["actors"] as $actorID) {
                    $actor = $PersonRepo->getPersonById($actorID);
                    $film->addActor($actor);
                }
        
                $film->removeAllGenre();
                foreach ($_POST["genres"] as $genreID) {
                    $genre = $GenreRepo->getById($genreID);
                    $film->addGenre($genre);
                }
                $FilmRepo = new \App\Repository\FilmRepository();
                $FilmRepo->Update($film);
                $_SESSION["update"] = $film->getTitle(). " updated";
                header("location: index.php");
            } 
        } 
           
        
        
        require_once '..\template\admin\update_movie.phtml';
    }

    public function add() {
        $GenreRepo = new \App\Repository\GenreRepository();
        $genres = $GenreRepo->getAll();
        
        $PersonRepo = new \App\Repository\PersonRepository();
        $actors = $PersonRepo->getActors();
        $directors = $PersonRepo->getDirectors();
        
        $error = "";
        
        if (isset($_POST["addNew"])) {
            if (
                empty($_POST["title"]) || empty($_POST["manufacture"]) || empty($_POST["link"])
                || empty($_POST["img"]) || empty($_POST["description"]) || empty($_POST["director"])
                || empty($_POST["actors"]) || empty($_POST["genres"])
            ) {
                $error = "Please complete all information.";
            } else {
                $film = new \App\Model\Film();
                $film->setTitle($_POST["title"]);
                $film->setManufacture($_POST["manufacture"]);
                $film->setLink($_POST["link"]);
                $film->setImg($_POST["img"]);
                $film->setDescription($_POST["description"]);
        
                $director = $PersonRepo->getPersonById($_POST["director"]);
                $film->addDirector($director);
        
                foreach ($_POST["actors"] as $actorID) {
                    $actor = $PersonRepo->getPersonById($actorID);
                    $film->addActor($actor);
                }
        
                foreach ($_POST["genres"] as $genreID) {
                    $genre = $GenreRepo->getById($genreID);
                    $film->addGenre($genre);
                }
        
                $FilmRepo = new \App\Repository\FilmRepository();
                $FilmRepo->insert($film);
        
                header('location: index.php');
        
            } 
        } 
        
        require_once "../template/admin/add_movie.phtml";
    }

    public function delete() {
        $GenreRepo = new \App\Repository\GenreRepository();
        $genres = $GenreRepo->getAll();
        
        if (isset($_POST["no"])) {
            unset($_SESSION['delete']);
            header("location: index.php");
        }
        
        if (isset($_POST["yes"]) && isset($_GET['id'])) 
        {
            $filmID = $_GET['id'];
            $FilmRepo = new \App\Repository\FilmRepository();
            $film = $FilmRepo->getByFilmID($filmID);
            $FilmRepo->Delete($film);
            $_SESSION["delete"] = $film->getTitle(). " deleted";
            header("location: index.php");
        }
        
        require "../template/admin/delete_movie.phtml";
    }
}