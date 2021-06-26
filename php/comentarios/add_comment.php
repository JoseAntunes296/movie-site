<?php
date_default_timezone_set('Europe/Lisbon');
include "../conecao/conecao.php";
$movie_title=$_GET['id1'];
$text=$_GET['text'];
$id_user=$_GET['id'];

$sql = "SELECT * FROM filmes WHERE name='$movie_title'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id_movie=$row['id_movie'];
    }
  }
  $data2 = (new \DateTime())->format('Y-m-d H:i:s');
$q=$conn->query("INSERT INTO `comentarios`(`id_sender`, `comentario`, `id_filme`, `data`) VALUES ($id_user,'$text',$id_movie,'$data2')");
header("location:../../movie.php?title=$movie_title");