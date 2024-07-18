<?php
require_once "../include/inc.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id == 2 && isset($_POST['Psubmit']) && isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['birthday']) && isset($_POST['role'])) {
        $person = new Person();
        $person->setName($_POST['name']);
        $person->setGender($_POST['gender']);
        $person->setBirthday($_POST['birthday']);
        $person->setRole($_POST['role']);
        $personRepo = new PersonRepository;
        $personRepo->insert($person);
        $id = $_GET['id'];
        header("location: ../admin/list_movie.php?id=$id");
    } elseif ($id == 1 && isset($_POST['Gsubmit']) && isset($_POST['genre'])) {
        $genre = new Genre();
        $genre->setName($_POST['genre']);
        $GenreRepo = new GenreRepository;
        $GenreRepo->insert($genre);
        $id = $_GET['id'];
        header("location: ../admin/list_movie.php?id=$id");
    } else {
        echo "Dien vao form";
    }
} else {
    echo "khong co id";
}

?>
<form method="post">
    <p>Add a new person</p>
    <p>Name:<input type="text" name="name"></p>
    <p>Gender:
        <select name="gender" id="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </p>
    <p>Birthday: <input type="year" name="birthday"></p>
    <p>Role:
        <select name="role">
            <option value="actor">Actor</option>
            <option value="director">Director</option>
        </select>
    </p>
    <input type="submit" name=Psubmit>
</form>
<form method="post">
    <p>Add a new genre</p>
    <input type="text" name="genre">
    <input type="submit" name=Gsubmit>
</form>