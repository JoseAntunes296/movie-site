<?php
include "php/conecao/conecao.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="css/index/style.css">
    <link rel="stylesheet" href="css/index/navbar.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- js -->
    <script src="js/index/script.js"></script>

</head>

<body style="background-color: #ccc;">
    <div id="header">
        <h1>MOVIES.TV</h1>
    </div>
    <div class="container">

        <?php
        $q = $conn->query("SELECT name,image FROM filmes");
        if ($q->num_rows > 0) {
            // output data of each row
            while ($row = $q->fetch_assoc()) {

                echo '<a href="movie.php?title=' . $row['name'] . '" class="item tilt-poster">'; ?>
                <?php echo '<div class="poster" style="background-image: url(img_uploads/' . $row['image'] . ')">
            </div>'; ?>
                <?php echo '<p>' . $row['name'] . '</p>'; ?>
                </a>
        <?php
            }
        }
        ?>
    </div>
    <nav class="nav" style="margin-left: -1rem;">
        <a href="#" class="nav__link">
            <i class="material-icons nav__icon">Lista de Filmes</i>
            <span class="nav__text">Movies List</span>
        </a>

        <?php

        if (!isset($_SESSION['id_user'])) {
            echo '<a href="./autenticacao/login.php" class="nav__link">
            <i class="material-icons nav__icon">Autenticação</i>
            <span class="nav__text">Authentication</span>
        </a>';
        } else {
            $id_user = $_SESSION['id_user'];
            $sql = "SELECT * FROM users WHERE id_user=$id_user";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '
        <a href="php/perfil/acc.php" class="nav__link">
        <i class="material-icons nav__icon">Perfil</i>
        <span class="nav__text">Profile</span>
    </a>
                    <a href="./autenticacao/logout.php" class="nav__link">
                    <i class="material-icons nav__icon">' . $row['username'] . '</i>
                    <span class="nav__text">Sair</span>
                </a>';
                }
            }
        }
        ?>
        <a href="./lista_favs.php" class="nav__link">
            <i class="material-icons nav__icon">Lista de Vizualização</i>
            <span class="nav__text">Watch List</span>
        </a>
        <?php

        if (isset($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user'];
            $sql = "SELECT * FROM users WHERE id_user=$id_user";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['cargo'] == 1) {
                        echo '<a href="#" class="nav__link">
                    <i class="material-icons nav__icon">Administração</i>
                    <span class="nav__text">Administration</span>
                </a>';
                    }
                }
            }
        }
        ?>
    </nav>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/gijsroge/tilt.js/38991dd7/dest/tilt.jquery.js"></script>

</body>

</html>