<?php 
include "../php/conecao/conecao.php";
set_time_limit(10020);

$i=0;

for($i=1270;$i<=1756;$i++){
    var_dump($i);
    $sql=$conn->query("UPDATE filmes SET image=$i+1 WHERE id_movie=$i");
}