<?php
include "../conecao/conecao.php";
session_start();
$Username=$_POST['Username1'];
$Password=$_POST['Password1'];

//verificacao caso os campos estejam vazios
if (empty($Username) || empty($Password)) {
	$_SESSION['status'] = "Precisa de preencher todos os campos!";
} else {
	$sql = "SELECT * FROM users WHERE `username` = '$Username'";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();
	$pass_hash = $row['password'];
	$count = mysqli_num_rows($result);
	$id = $row['id_user'];
	if ($count == 1) {
		if (md5($Password) === $pass_hash) {
			
				$_SESSION["id_user"] = $id;
				header("location:../../index.php");
}
}
}