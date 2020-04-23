 <?php
 session_start();
 $host = "localhost";
 $username = "root";
 $password = "";
 $database = "db_testeweb";
 $message = "";
 try
 {
	  $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
	  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  if(isset($_POST["login"]))
	  {
		   if(empty($_POST["email"]) || empty($_POST["password"]))
		   {
				$message = '<label>All fields are required</label>';
		   }
		   else
		   {
				$query = "SELECT * FROM usuario WHERE email = :email AND password = :password AND flag_permissao = :flag_permissao";
				$statement = $connect->prepare($query);
				$statement->execute(
					 array(
						  'email'     		=>  $_POST["email"],
						  'password'     	=>  $_POST["password"],
						  'flag_permissao'	=>	$_POST["flag_permissao"],
					 )
				);
				$count = $statement->rowCount();

				if($count > 0){
					 if		('flag_permissao' == 0) {header("location: pessoa_index.php");}
					 elseif ('flag_permissao' == 1) {header("location: telaInicial_user.php");}
                     else {echo ("é numeragem diferente");}
				}//if($count > 0){
				else { $message = '<label>Algum campo está errado</label>';	}
		   }
	  }
 }
 catch(PDOException $error)
 {
	  $message = $error->getMessage();
 }
 ?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
	<head>
		<title>Sistema Suzano'o</title>

		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible"  content="IE=edge">
		<meta name="author"                 content="Israel da Cunha Pereira">
		<meta name="description"            content="Sistema Suzano'o">
		<meta name="viewport"               content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap OFFLINE and MY DEFAULT-->
			<!--retirando erro de favicon [googleChrome], sendo root & se o documento é HTML5 -->
			<link rel="icon"            href="data:;base64,iVBORw0KGgo=">
			<link rel="shortcut icon"   href="favicon.ico">

		<!-- Bootstrap ONLINE and DEFAULT-->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>

  <body>
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Suzano</a>
		<!--
		<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		<ul class="navbar-nav px-3"><li class="nav-item text-nowrap"><a class="nav-link" href="index.php">Sign out</a></li></ul>
		-->

	</nav>

		   <div class="container" style="width:500px;">
				<?php if(isset($message)) {echo '<label class="text-danger">'.$message.'</label>';} ?>
				<h3 align="center">LOGIN</h3><br />
				<form method="post">
					 <label>email</label>       <input type="text"      name="email"    class="form-control" />
					 <br />
					 <label>password</label>    <input type="password"  name="password" class="form-control" />
					 <br />

					<tr>
						<td>Sou Usuário do tipo<br><br>
						<td>
							<div class="radio">
								<label>		<input type="radio" name="flag_permissao" value="0"> Administrador				</label>
								<br>
								<label>		<input type="radio" name="flag_permissao" value="1"> Usuario	</label>
							</div>

							<div class="radio">

							</div>
						</td>
					</tr> <!-- tr de flagPermissao -->

					 <input type="submit" name="login" class="btn btn-info" value="login" />
                     <a href="cadastrando.php" button type="button" class="btn btn-warning">Novo Usuário</a></button>
				</form>
		   </div>






	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>