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
    <link rel="stylesheet" href="pagination.css">
    <link rel="stylesheet" href="/lib/bootstrap.min.css">

    <!-- js -->
    <script src="js/index/script.js"></script>
    <style>
        .rating_movie {
            align-items: center;
            background-color: #f68d01;
            border-radius: 50%;
            box-shadow: 0 0 1em rgba(0, 0, 0, 0.25);
            display: flex;
            height: 2.25em;
            justify-content: center;
            padding: 0.5em;
            position: relative;
            right: -10rem;
            text-align: center;
            top: -4%;
            width: 2.25em;
        }
    </style>

</head>

<body style="background-color: #ccc;">
    <div id="header">
        <h1>MOVIES.TV</h1>
    </div>
    <div class="container" style="margin: 10rem 10rem 10rem 10rem;">
        <?php

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 40;
        $offset = ($pageno - 1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM filmes";
        $result = mysqli_query($conn, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM filmes LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($res_data)) {
            echo '<a href="movie.php?id_movie=' . $row['id_movie'] . '" class="item tilt-poster">
            <div class="poster" style="background-image: url(img_uploads/' . $row['image'] . '.jpg)">
        <span class="rating_movie" >' . $row['rating'] . '</span>
            </div>
            <p>' . $row['name'] . '</p>'; ?>
            </a>
        <?php
        }
        ?><ul class="pagination">

            <li class="page-item">
                <a href="?pageno=1" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <li class="page-item <?php if ($pageno <= 1) {
                                        echo 'disabled';
                                    } ?>">
                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                echo '#';
                                            } else {
                                                echo "?pageno=" . ($pageno - 1);
                                            } ?>">1</a>
            </li>
            <li class="page-item <?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                    } ?>">
                <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                echo '#';
                                            } else {
                                                echo "?pageno=" . ($pageno + 1);
                                            } ?>">2</a>
            </li>
            <li class="page-item">
                <a href="?pageno=<?php echo $total_pages; ?>" class="page-link" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </div>

    <nav class="nav" style="margin-left: -1rem;">
        <a href="index.php" class="nav__link">
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
                        echo '<a href="administracao/index.html" class="nav__link">
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