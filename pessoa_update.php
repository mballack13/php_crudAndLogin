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
 							<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

							<!--botão principal {QUESTIONÁRIO}-->
							<br><br>
							<a class="nav-link" href="questionario_index.php">
								<div style="text-align:center;">
									<svg class="feather"
									fill="none"	height="2"
									stroke-linecap="round"	stroke-linejoin="round"	stroke-width="2"	stroke="currentColor"
									viewBox="0 0 24 24"	width="2"
									xmlns="http://www.w3.org/2000/svg">
										<i data-feather="help-circle"></i>
									</svg>QUESTIONÁRIO
								</div>
							</a>

						</li> <!-- <li class="nav-item"> -->
					</ul> <!-- <ul class="nav flex-column"> -->
				</div> <!-- <div class="sidebar-sticky"> -->
			</nav> <!-- <nav class="col-md-2 d-none d-md-block bg-light sidebar"> -->




			<nav class="col-md-10">
				<?php
				        // get passed parameter value, in this case, the record ID
				        // isset() is a PHP function used to verify if a value is there or not
				        $id_usuario=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

				        //include database connection
				        include 'config/database.php';

					try{
				            // prepare select query
				            $query = "	SELECT usu.id_usuario, usu.nome, usu.password, usu.endereco,
                            usu.email, usu.contato_telefonico, usu.flag_permissao
				            			FROM usuario usu
				            			WHERE usu.id_usuario = ?
				            			";
				            $stmt = $con->prepare( $query );

				            // this is the first question mark
				            $stmt->bindParam(1, $id_usuario);

				            // execute our query
				            $stmt->execute();

				            // store retrieved row to a variable
				            $row = $stmt->fetch(PDO::FETCH_ASSOC);

				            // values to fill up our form
							$nome = $row['nome'];
                            $password = $row['password'];
							$endereco = $row['endereco'];
							$email = $row['email'];
							$contato_telefonico = $row['contato_telefonico'];
							$flag_permissao = $row['flag_permissao'];

				        }

				        // show error
				        catch(PDOException $exception){
				            die('ERROR: ' . $exception->getMessage());
				        }
				        ?>

				        <?php

				        // check if form was submitted
				        if($_POST){

				            try{

				                // write update query
				                // in this case, it seemed like we have so many fields to pass and
				                // it is better to label them and not use question marks
				                $query = "	UPDATE usuario usu
				                			SET	nome=:nome,
                                            password=:password,
				                			endereco=:endereco,
				                			email=:email,
				                			contato_telefonico=:contato_telefonico,
				                			flag_permissao=:flag_permissao
				                			WHERE id_usuario=:id_usuario
                                            ";




				                // prepare query for excecution
				                $stmt = $con->prepare($query);

				                // posted values
								$nome				=htmlspecialchars(strip_tags($_POST['nome']));
                                $password               =htmlspecialchars(strip_tags($_POST['password']));
								$endereco			=htmlspecialchars(strip_tags($_POST['endereco']));
								$email				=htmlspecialchars(strip_tags($_POST['email']));
								$contato_telefonico	=htmlspecialchars(strip_tags($_POST['contato_telefonico']));
								$flag_permissao		=htmlspecialchars(strip_tags($_POST['flag_permissao']));

				                // bind the parameters
				                $stmt->bindParam(':nome', $nome);
                                $stmt->bindParam(':password', $password);
				                $stmt->bindParam(':endereco', $endereco);
				                $stmt->bindParam(':email', $email);
				                $stmt->bindParam(':contato_telefonico', $contato_telefonico);
				                $stmt->bindParam(':flag_permissao', $flag_permissao);
				                $stmt->bindParam(':id_usuario', $id_usuario);


				                // Execute the query
				                if($stmt->execute())
								{echo "<div class='alert alert-success'>Record was updated.</div>";}

				            	else
				            	{echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";}

				            }

				            // show errors
				            catch(PDOException $exception){
				                die('ERROR: ' . $exception->getMessage());
				            }
				        }
				        ?>

				        <!--we have our html form here where new record information can be updated-->
				        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id_usuario}");?>" method="post">
				            <table class='table'>
				                <tr>
				                    <td>nome</td>
				                    <td><input type='text' name='nome' value="<?php echo htmlspecialchars($nome, ENT_QUOTES);  ?>" class='form-control' /></td>
				                </tr>
				                <!--
				                <tr>
				                    <td>Description</td>
				                    <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
				                </tr>
				            	-->
				                <tr>
				                    <td>endereco</td>
				                    <td><input type='text' name='endereco' value="<?php echo htmlspecialchars($endereco, ENT_QUOTES);  ?>" class='form-control' /></td>
				                </tr>
				                <tr>
				                    <td>email</td>
				                    <td><input type='text' name='email' value="<?php echo htmlspecialchars($email, ENT_QUOTES);  ?>" class='form-control' /></td>
				                </tr>
				                <tr>
				                    <td>contato_telefonico</td>
				                    <td><input type='text' name='contato_telefonico' value="<?php echo htmlspecialchars($contato_telefonico, ENT_QUOTES);  ?>" class='form-control' /></td>
				                </tr>
				                <tr>
				                    <td>flag_permissao</td>
				                    <td><input type='text' name='flag_permissao' value="<?php echo htmlspecialchars($flag_permissao, ENT_QUOTES);  ?>" class='form-control' /></td>
				                </tr>





				                	<tr>
				                	<td></td>
				                	<td>
				                	<input type='submit' value='Save Changes' class='btn btn-primary' />
				                	<a href='cv_index.php' class='btn btn-danger'>Voltar-Pessoa</a>
				                	</td>
				                	</tr>
				                </table> <!-- <table class="table"> -->
							</form> <!-- <form action="............" method="post"> -->
						</nav> <!-- <nav class="col-md-2"> -->
					</div> <!-- <div class="row"> -->
				</div> <!-- <div class="container-fluid"> -->



		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

		<!-- Latest compiled and minified Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script>feather.replace()</script>

</body>
</html>