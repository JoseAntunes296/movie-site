<?php
include "../conecao/conecao.php";
session_start();
$session_user = $_SESSION['id_user'];
$id_movie = $_GET['id'];
$q = "SELECT * FROM filmes WHERE id_movie=$id_movie";
$result = $conn->query($q);
$r = $conn->query("SELECT * FROM users WHERE id_user=" . $session_user);
$add = $conn->query("SELECT * FROM add_to_list WHERE id_user=" . $session_user);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $name_movie = $row['name'];
    }
}
if ($r->num_rows > 0) {
    // output data of each row
    while ($row = $r->fetch_assoc()) {
        $id_user = $row['id_user'];
    }
}
if ($add->num_rows > 0) {
    // output data of each row
    while ($row = $add->fetch_assoc()) {
        $id_user = $row['id_user'];
        if (!empty($row)) {
            $delete = $conn->query("DELETE FROM `add_to_list` WHERE id_user=$id_user and id_movie=$id_movie");
            header("location:../../movie.php/title=$name_movie");
        }
    }
} else {
    $w = $conn->query("INSERT INTO `add_to_list`(`id_user`, `id_movie`) VALUES ($id_user,$id_movie)");
    header("location:../../movie.php/title=$name_movie");
}
