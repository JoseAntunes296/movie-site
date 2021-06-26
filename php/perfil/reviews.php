<?php
include "../conecao/conecao.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
  #header {
    height: 4em !important; 
    position: fixed !important;
    top: 0 !important;
    width: 100% !important;
    background-color: black !important;
    position: fixed !important;
    z-index: 2 !important;
    left: 0 !important;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
  }
  
  h1 {
    font-size: 2em;
    color: white;
    text-align: center;
    padding-top: 0.3em;
  } 
  </style>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- css -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

	<!-- Bootstrap 4 CSS -->
	<link rel="stylesheet" type="text/css" href="../../lib/bootstrap.min.css" />
	<!-- Jquery -->
	<script type="text/javascript" src="../../lib/jquery-3.5.1.min.js"></script>
	<!-- Bootstrap Js 4 -->
	<script type="text/javascript" src="../../lib/bootstrap.min.js"></script>

</head>

<body style="background-color: #ccc;">
	<div id="header">
		<h1>MOVIES.TV</h1>
	</div>
	<!-- Content Start -->
	<main class="container">
		<h3 class="border-bottom pb-2 mt-3">My Account</h3>
		<div class="row mt-4">
			<!-- Left Sidebar -->
			<div class="col-12 col-sm-3">
				<div class="card">
					<h5 class="card-header">Settings</h5>
					<div class="list-group list-group-flush">
						<a href="acc.php" class="list-group-item">Profile</a>
						<a href="reviews.php" class="list-group-item">My Reviews</a>
						<a href="change-password.php" class="list-group-item">Change Password</a>
						<a href="../../autenticacao/logout.php" class="list-group-item text-danger">Logout</a>
					</div>
				</div>
			</div>
			<!-- ##	End -->
			<!-- Right Content -->
			<div class="col-12 col-sm-9">
				<div class="card">
					<h5 class="card-header">Reviews</h5>
					<div class="card-body">
						<form>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Filme</th>
										<th>Comentário</th>
										<th>Ação</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$user_id=$_SESSION['id_user'];
									$sql = "SELECT * FROM `comentarios` INNER JOIN users ON users.id_user=comentarios.id_sender INNER JOIN filmes ON filmes.id_movie=comentarios.id_filme WHERE users.id_user='$user_id'";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
										// output data of each row
										while ($row = $result->fetch_assoc()) {
											?>
									<tr>
										<td>
											<?php echo '<a href="detail.php">'.$row['name'].'</a>'; ?>
										</td>
										<?php echo '<td>'.$row['comentario'].'</td>'; ?>
										<td>
										<?php echo '<a href="#" class="btn btn-sm btn-danger">Delete</a>'; ?>
										</td>
									</tr>
											<?php
										}
									}

									?>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
			<!-- ##	End -->
		</div>
	</main>
</body>

</html>