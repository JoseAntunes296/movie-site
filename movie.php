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
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" type="text/css" href="lib/bootstrap.min.css" />
    <!-- Jquery -->
    <script type="text/javascript" src="lib/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap Js 4 -->
    <script type="text/javascript" src="lib/bootstrap.min.js"></script>
</head>

<body style="background-color: #ccc;">
    <main class="container pb-5">
        <?php
        $name_movie = $_GET['title'];
        $q = $conn->query("SELECT * FROM filmes where name='$name_movie'");
        if ($q->num_rows > 0) {
            // output data of each row
            while ($row = $q->fetch_assoc()) {
                echo '<h3 class="border-bottom pb-2 mt-3">' . $row['name'] . '</h3>';
        ?>
                <div class="row mt-4">
                    <!-- Left Content -->
                    <div class="col-12 col-sm-8">
                        <?php echo '<p><img style="width: 22rem;" src="img_uploads/' . $row['image'] . '" class="img-fluid" /></p>'; ?>
                        <div class="movie-content">
                            <h5>Sinopse</h5>
                            <?php echo '<p>' . $row['desc'] . '</p>'; ?>
                            <hr />
                            <?php
                            if (isset($_SESSION['id_user'])) {
                            ?>
                                <!-- Add Comment Start -->
                                <div class="card mt-4">
                                    <h5 class="card-header">Comentários</h5>
                                    <div class="card-body">
                                        <form method="GET" action="./php/comentarios/add_comment.php">
                                            <textarea name="text" id="text" class="form-control" placeholder="Comente aqui..."></textarea>
                                            <?php
                                            $id_user = $_SESSION['id_user'];
                                            echo '<input type="hidden" name="id" id="id" value="' . $id_user . '" />
                                        <input type="hidden" name="id1" id="id1" value="' . $name_movie . '" />'; ?>
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
                                        $sql = "SELECT * FROM comentarios INNER JOIN users ON users.id_user=comentarios.id_sender INNER JOIN filmes ON comentarios.id_filme=filmes.id_movie WHERE name='$name_movie'";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <blockquote class="blockquote">

                                                    <?php echo '<p class="mb-0">' . $row['comentario'] . '</p>
                                        <footer class="blockquote-footer">Comentado por: ' . $row['username'] . '</footer>'; ?>
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
                        <!-- Search Start -->
                        <div class="card mb-4">
                            <h5 class="card-header">Search</h5>
                            <div class="card-body">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Movies" />
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="button" id="button-addon2">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Search End -->
                        <!-- Top Movies -->
                        <div class="card mb-4">
                            <h5 class="card-header">Top Movies</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="#">Movie 1 <span class="float-right badge badge-warning">5/5</span></a></li>
                                <li class="list-group-item"><a href="#">Movie 2 <span class="float-right badge badge-warning">4.5/5</span></a></li>
                                <li class="list-group-item"><a href="#">Movie 3 <span class="float-right badge badge-warning">4/5</span></a></li>
                                <li class="list-group-item"><a href="#">Movie 4 <span class="float-right badge badge-warning">4/5</span></a></li>
                                <li class="list-group-item"><a href="#">Movie 5 <span class="float-right badge badge-warning">4/5</span></a></li>
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