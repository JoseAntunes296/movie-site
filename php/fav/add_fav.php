<?php
include "../conecao/conecao.php";
$id_user=$_GET['id_user'];
$id_movie=$_GET['id_movie'];

$sql = "SELECT * FROM users INNER JOIN add_to_list ON users.id_user=add_to_list.id_user INNER JOIN filmes ON filmes.id_movie=add_to_list.id_movie WHERE users.id_user=$id_user && filmes.id_movie=$id_movie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if($row['status']=='Inactive'){                                            
            $q=$conn->query("UPDATE add_to_list SET status='Active' WHERE id_user=$id_user && id_movie=$id_movie");
            header("location:../../movie.php?id_movie=$id_movie");
        }
    }
}else{
     $q=$conn->query("INSERT INTO add_to_list(id_user,id_movie,status) VALUES ($id_user,$id_movie,'Active')");
     header("location:../../movie.php?id_movie=$id_movie");
}

