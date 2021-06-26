<?php 
session_start();
if (isset($_SESSION['id_user'])) {
header("location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="../css/autenticacao/style.css">
</head>

<body>
    <div class="container">
        <div class="card"></div>
        <div class="card">
            <h1 class="title">Login</h1>
            <form action="../php/autenticacao/validar_autenticacao.php" method="POST">
                <div class="input-container">
                    <input type="Username" name="Username1" id="Username1" minlength="8" maxlength="30" required="required" />
                    <label for="Username1">Username</label>
                    <div class="bar"></div>
                </div>
                <div class="input-container">
                    <input type="Password" name="Password1" id="Password1" minlength="8" maxlength="30" required="required" />
                    <label for="Password1">Password</label>
                    <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button><span>Go</span></button>
                </div>
                <div class="footer"><a href="#">Forgot your password?</a></div>
            </form>
        </div>
        <div class="card alt">
            <div class="toggle"></div>
            <h1 class="title">Register
                <div class="close"></div>
            </h1>
            <form action="../php/autenticacao/validar_registo.php" method="POST">
                <div class="input-container">
                    <input type="Email" name="Email" id="Email" required="required" />
                    <label for="Email">Email</label>
                    <div class="bar"></div>
                </div>
                <div class="input-container">
                    <input type="text" name="Username" id="Username" minlength="8" maxlength="30" required="required" />
                    <label for="Username">Username</label>
                    <div class="bar"></div>
                </div>
                <div class="input-container">
                    <input type="Password" name="Password" id="Password" minlength="8" maxlength="30" required="required" />
                    <label for="Password">Password</label>
                    <div class="bar"></div>
                </div>
                <div class="input-container">
                    <input type="Password" name="repPassword" id="repPassword" minlength="8" maxlength="30" required="required" />
                    <label for="repPassword">Repeat Password</label>
                    <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button><span>Next</span></button>
                </div>
            </form>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="../js/autenticacao/script.js"></script>
</body>

</html>