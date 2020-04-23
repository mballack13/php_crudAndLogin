<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
	<head>
		<title>Sistema Suzano'o</title>

		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible"	content="IE=edge">
		<meta name="author" 				content="Israel da Cunha Pereira">
		<meta name="description"			content="Sistema Suzano'o">
		<meta name="viewport"				content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap OFFLINE and MY DEFAULT-->
			<!--retirando erro de favicon [googleChrome], sendo root & se o documento é HTML5 -->
			<link rel="icon"			href="data:;base64,iVBORw0KGgo=">
			<link rel="shortcut icon"	href="favicon.ico">

		<!-- Bootstrap ONLINE and DEFAULT-->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  			<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  			<script src="https://unpkg.com/feather-icons"></script>



		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>



	<body>
		<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
			<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Suzano'o</a>
				<!--
					<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
				-->
			<ul class="navbar-nav px-3"><li class="nav-item text-nowrap"><a class="nav-link" href="index.php">Sign out</a></li></ul>
		</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item">

							<!--botão principal {PESSOA}-->
							<a class="nav-link" href="pessoa_index.php">
								<div style="text-align:center;">
									<svg class="feather"
									fill="none"	height="2"
									stroke-linecap="round"	stroke-linejoin="round"	stroke-width="2"	stroke="currentColor"
									viewBox="0 0 24 24"	width="2"
									xmlns="http://www.w3.org/2000/svg">
										<i data-feather="users"></i>
									</svg>PESSOA
								</div>
							</a>

							<!--botão secundário {PESSOA}-->
							<a class="nav-link" href="pessoa_create.php">
								<div style="text-align:center;">
									<svg class="feather"
									fill="none"	height="2"
									stroke-linecap="round"	stroke-linejoin="round"	stroke-width="2"	stroke="currentColor"
									viewBox="0 0 24 24"	width="2"
									xmlns="http://www.w3.org/2000/svg">
										<i data-feather="users"></i>
									</svg>criar
								</div>
							</a>

						</li> <!-- <li class="nav-item"> -->
					</ul> <!-- <ul class="nav flex-column"> -->
				</div> <!-- <div class="sidebar-sticky"> -->
			</nav> <!-- <nav class="col-md-2 d-none d-md-block bg-light sidebar"> -->




				<div class="col-sm-10">

					<?php
					// include database connection
					include 'config/database.php';


					$action = isset($_GET['action']) ? $_GET['action'] : "";

					// if it was redirected from delete.php
					if($action=='deleted'){echo "<div class='alert alert-success'>Record was deleted.</div>";}

					// select all data
					$query = "	SELECT id_usuario, nome, password, endereco, email, contato_telefonico, flag_permissao
								FROM usuario
								ORDER BY id_usuario ASC";
					$stmt = $con->prepare($query);
					$stmt->execute();

					// this is how to get number of rows returned
					$num = $stmt->rowCount();

					// link to create record form
					//echo "<a href='pessoa_create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";

					//check if more than 0 record found
					if($num>0){

					// data from database will be here
					echo "<table class='table'>";//start table

					//creating our table heading
					echo "<tr>";
					echo "<th>id_usuario</th>";
					echo "<th>nome</th>";
                    echo "<th>password</th>";
					echo "<th>endereco</th>";
					echo "<th>email</th>";
					echo "<th>contato_telefonico</th>";
					echo "<th>flag_permissao</th>";
					echo "</tr>";

					// retrieve our table contents
					// fetch() is faster than fetchAll()
					// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					// extract row
					// this will make $row['firstname'] to
					// just $firstname only
					extract($row);

					// creating new table row per record
					echo "<tr>";
					echo "<td>{$id_usuario}</td>";
					echo "<td>{$nome}</td>";
                    echo "<td>{$password}</td>";
					echo "<td>{$endereco}</td>";
					echo "<td>{$email}</td>";
					echo "<td>{$contato_telefonico}</td>";
					echo "<td>{$flag_permissao}</td>";
					echo "<td>";
					// read one record
					// aqui voce informa qual o id do usuário

					// we will use this links on next part of this post
					echo "<a href='pessoa_update.php?id={$id_usuario}' class='btn btn-primary btn-sm'>EDITAR</a>"."<br>";

					// we will use this links on next part of this post
					echo "<a href='#' onclick='delete_user({$id_usuario});'  class='btn btn-danger btn-sm'>APAGAR</a>"."<br>";
					echo "</td>";
					echo "</tr>";
					}//while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					// end table
					echo "</table>";
					}//if($num>0){

					// if no records found
					else 	{echo "<div class='alert alert-danger'>No records found.</div>";}
					?>
					</div> <!-- <div class="container"> -->

					<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
					<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

					<!-- Latest compiled and minified Bootstrap JavaScript -->
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

					<script type='text/javascript'>
					// confirm record deletion
					function delete_user(id_usuario){

					    var answer = confirm('Are you sure?');
					    if (answer){
					        // if user clicked ok,
					        // pass the id to delete.php and execute the delete query
					        window.location = 'pessoa_delete.php?id_usuario=' + id_usuario;
					    }
					}
					</script>

				</div>


		</div>	<!-- <div class="row"> -->
	</div> <!-- <div class="container-fluid"> -->
















		</div>	<!-- <div class="row"> -->
	</div> <!-- <div class="container-fluid"> -->

<br><br><br>




		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

		<!-- Latest compiled and minified Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script>feather.replace()</script>


	</body>
</html>