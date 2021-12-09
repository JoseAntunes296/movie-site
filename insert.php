<?php 
include "php/conecao/conecao.php";

$sql = "SELECT * FROM filmes";
$result = $conn->query($sql);

if ($result->num_rows < 0) {
    echo "autowrite should run";
    $sql2 = "INSERT INTO  VALUES (0)";
    $result2 = $conn->query($sql2);
}