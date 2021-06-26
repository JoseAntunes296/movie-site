<?php
include "../conecao/conecao.php";

$email=$_POST['Email'];
$Username=$_POST['Username'];
$Password=$_POST['Password'];
$RepPassword=$_POST['repPassword'];
//verificacao caso os campos estejam vazios
$verify="SELECT * from users WHERE username='.$Username.' or email='.$email.'";
$result = $conn->query($verify);
if ($result->num_rows > 0) {
    header("location:../../autenticacao/login.php");
}else{
if (empty($email) || empty($Username) || empty($Password) || empty($RepPassword)) {
	$_SESSION['status'] = "Precisa de preencher todos os campos!";
}elseif($Password==$RepPassword) {
    $pass_encrypt=md5($Password);
	$insert=$conn->query("INSERT INTO `users`(`username`, `password`, `email`,`cargo` , `status`) VALUES ('$Username','$pass_encrypt','$email',1,'Activo')");
    header("location:../../autenticacao/login.php");
}else{
    $_SESSION['status'] = "Password não compatível!";
}
}