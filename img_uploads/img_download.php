<?php
include "../php/conecao/conecao.php";
set_time_limit(10020);
//change id//
$sql = "SELECT * FROM filmes WHERE id_movie>1268";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    // Remote image URL
    $img[]=$row['image'];
  }
}
$i = 1270;
foreach ($img as $value) {
    $url = 'https://image.tmdb.org/t/p/w1280' . $value;
    copy($url,"$i.jpg");
    $i++;
    var_dump(copy($url,"$i.jpg"));  
}