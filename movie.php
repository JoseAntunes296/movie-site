<?php
include "php/conecao/conecao.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- css -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" integrity="sha384-v8BU367qNbs/aIZIxuivaU55N5GPF89WBerHoGA4QTcbUjYiLQtKdrfXnqAcXyTv" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="css/index/style.css">
    <link rel="stylesheet" href="pagination.css">
    <link rel="stylesheet" href="css/index/navbar.css">
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" type="text/css" href="lib/bootstrap.min.css" />
    <!-- Jquery -->
    <script type="text/javascript" src="lib/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap Js 4 -->
    <script type="text/javascript" src="lib/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .list {
            padding: 0;
            margin: 0;
            font-size: 0;
            display: block;
        }

        .list__item {
            display: flex;
            padding: 40px 0;
            border-bottom: 1px solid #ddd;
            margin: 0 0 40px 0;
        }

        .list__item:last-child {
            margin: 0;
            padding: 0;
            border: 0;
        }

        .list__figure {
            display: block;
            width: 250px;
            height: 250px;
            padding: 0;
            margin: 0;
        }

        .list__image {
            display: block;
            width: 100%;
            height: 100%;
        }

        .list__block {
            display: inline-block;
            vertical-align: top;
            width: 250px;
            box-sizing: border-box;
            position: relative;
        }

        .list__notification {
            position: absolute;
            top: 10px;
            font-size: 16px;
            left: 10px;
            background: red;
            font-weight: bold;
            color: #ffffff;
            border-radius: 4px;
            padding: 4px 10px;
        }

        .list__block:last-child {
            width: calc(100% - 250px);
            padding: 0 80px 0 30px;
        }

        .list__text {
            display: block;
            margin: 0 0 20px 0;
        }

        .list__text--bold {
            font-weight: bold;
        }

        .list__text--big {
            font-size: 35px;
        }

        .list__text--small {
            font-size: 18px;
        }

        .list__actions {
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .list__link {
            font-size: 16px;
            text-decoration: none;
            background: #222;
            border-radius: 4px;
            margin: 0 20px 0 0;
            padding: 8px 10px;
            color: #fff;
            display: inline-block;
        }

        .list__link:last-child {
            margin: 0;
        }

        .list__group {
            display: block;
            position: relative;
            margin: 40px 0 0 0;
        }

        .list__icon {
            display: inline-block;
            vertical-align: middle;
        }

        .list__description {
            display: inline-block;
            vertical-align: middle;
        }

        .list__bottom {
            position: absolute;
            bottom: 0;
            right: 20px;
        }
    </style>
</head>

<body style="background-color: #ccc;">
    <div id="header">
        <h1><a href="index.php" style="color: #fff !important;text-decoration: none;">MOVIES.TV</a></h1>
    </div>
    <main class="container pb-5" style="margin-top: 5rem;">
        <?php
        $id_movie = $_GET['id_movie'];
        $q = $conn->query("SELECT * FROM filmes where id_movie='$id_movie'");
        if ($q->num_rows > 0) {
            // output data of each row
            while ($row = $q->fetch_assoc()) {
                $id_movie1 = $row['id_movie'];
                $desc = $row['desc'];
                echo '<h3 class="border-bottom pb-2 mt-3">' . $row['name'] . '</h3>';
        ?>
                <div class="row mt-4">
                    <!-- Left Content -->
                    <div class="col-12 col-sm-8">
                        <?php echo '<p><img style="width: 22rem;" src="img_uploads/' . $row['image'] . '.jpg" class="img-fluid" /></p>'; ?>
                        <div class="movie-content">
                            <div class="list__group">
                                <?php
                                if (!empty($_SESSION['id_user'])) {
                                    echo '<br><hr>';
                                    $id_user1 = $_SESSION['id_user'];
                                    $sql = "SELECT * FROM users INNER JOIN add_to_list ON users.id_user=add_to_list.id_user INNER JOIN filmes ON filmes.id_movie=add_to_list.id_movie WHERE users.id_user=$id_user1 && filmes.id_movie=$id_movie1";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            if ($row['status'] == 'Inactive') {
                                                echo '<a href="php/fav/add_fav.php?id_movie=' . $id_movie1 . '&id_user=' . $id_user1 . '" style="color: #fff;" title="Option #1" class="list__link">
                                            <span class="list__icon fa fa-heart"></span>
                                            <span class="list__description">Adicionar</span></a>';
                                            } else {
                                                echo '<a href="php/fav/remove_fav.php?id_movie=' . $id_movie1 . '&id_user=' . $id_user1 . '" style="color: #fff;" title="Option #1" class="list__link">
                                            <span class="list__icon fa fa-heart"></span>
                                            <span class="list__description">Remover</span></a>';
                                            }
                                        }
                                    } else {
                                        echo '<a href="php/fav/add_fav.php?id_movie=' . $id_movie1 . '&id_user=' . $id_user1 . '" style="color: #fff;" title="Option #1" class="list__link">
                                    <span class="list__icon fa fa-heart"></span>
                                    <span class="list__description">Adicionar</span></a>';
                                    }
                                }
                                ?>
                            </div>
                            <br>
                            <hr>

                            <h5>Sinopse</h5>
                            <?php echo '<p>' . $desc . '</p>'; ?>
                            <hr />
                            <?php
                            if (isset($_SESSION['id_user'])) {
                            ?>
                                <!-- Add Comment Start -->
                                <div class="card mt-4">
                                    <h5 class="card-header">Comentar</h5>
                                    <div class="card-body">
                                        <form method="GET" action="./php/comentarios/add_comment.php">
                                            <textarea name="text" id="text" class="form-control" placeholder="Comente aqui..."></textarea>
                                            <?php
                                            $id_user = $_SESSION['id_user'];
                                            echo '<input type="hidden" name="id" id="id" value="' . $id_user . '" />
                                        <input type="hidden" name="id1" id="id1" value="' . $id_movie . '" />'; ?>
                                            <input type="submit" class="btn btn-dark mt-2" />
                                        </form>
                                    </div>
                                </div>
                                <!-- Add Comment End -->
                                <!-- List Comment Start -->
                                <div class="card mt-4">
                                    <h5 class="card-header">Comentários</h5>
                                    <div class="card-body">
                                        <?php
                                        $sql = "SELECT * FROM comentarios INNER JOIN users ON users.id_user=comentarios.id_sender INNER JOIN filmes ON comentarios.id_filme=filmes.id_movie WHERE id_movie='$id_movie'";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <blockquote class="blockquote">

                                                    <?php echo '<p class="mb-0">' . $row['comentario'] . '</p>
                                        <footer class="blockquote-footer">Comentado por: ' . $row['username'] . ' ' . $row['data'] . '</footer>'; ?>
                                                </blockquote>
                                                <hr />
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- List Comment End -->
                            <?php
                            } else {
                            ?>
                                <div class="card mt-4">
                                    <h5 class="card-header">Comentários</h5>
                                    <div class="card-body">

                                        <blockquote class="blockquote">
                                            <p class="mb-0"></p>
                                            <footer class="blockquote-footer">BLOQUEADO: FAÇA A DEVIDA AUTENTICAÇÃO PARA PODER COMENTAR AQUI</footer>
                                        </blockquote>
                                        <hr />

                                    </div>
                                </div>
                            <?php
                            }

                            ?>


                        </div>
                    </div>
                    <!-- Right Sidebar -->
                    <div class="col-12 col-sm-4">
                        <!-- Top Movies -->
                        <div class="card mb-4">
                            <h5 class="card-header">Top Movies</h5>
                            <ul class="list-group list-group-flush">
                                <?php

                                $sql = "SELECT * FROM filmes GROUP BY rating DESC LIMIT 20";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<?php <li class="list-group-item"><a href="movie.php?id_movie=' . $row['id_movie'] . '">' . $row["name"] . '<span class="float-right badge badge-warning">' . $row['rating'] . '</span></a></li>
                                        ';
                                    }
                                }
                                ?>
                            </ul>
                            <div class="card-footer">
                                <a href="#">View All</a>
                            </div>
                        </div>
                        <!-- End -->
                    </div>
                    <!-- ##	End -->
                </div>
        <?php
            }
        }
        ?>
    </main>
</body>

</html>