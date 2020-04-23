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

                        </li> <!-- <li class="nav-item"> -->
                    </ul> <!-- <ul class="nav flex-column"> -->
                </div> <!-- <div class="sidebar-sticky"> -->
            </nav> <!-- <nav class="col-md-2 d-none d-md-block bg-light sidebar"> -->


            <div class="col-sm-10">
                <?php
                if($_POST){

                    // include database connection
                    include 'config/database.php';

                    try{

                        // insert query
                        $query = "  INSERT INTO usuario
                                    SET nome=:nome,
                                        password=:password,
                                        endereco=:endereco,
                                        email=:email,
                                        contato_telefonico=:contato_telefonico,
                                        flag_permissao=:flag_permissao";

                        // prepare query for execution
                        $stmt = $con->prepare($query);

                        // posted values
                        //$id_usuario=htmlspecialchars          (strip_tags($_POST['id_usuario']));
                        $nome=htmlspecialchars                  (strip_tags($_POST['nome']));
                        $password=htmlspecialchars              (strip_tags($_POST['password']));
                        $endereco=htmlspecialchars              (strip_tags($_POST['endereco']));
                        $email=htmlspecialchars                 (strip_tags($_POST['email']));
                        $contato_telefonico=htmlspecialchars    (strip_tags($_POST['contato_telefonico']));
                        $flag_permissao=htmlspecialchars        (strip_tags($_POST['flag_permissao']));


                        // bind the parameters
                        //$stmt->bindParam  (':id_usuario', $id_usuario);
                        $stmt->bindParam    (':nome',                   $nome);
                        $stmt->bindParam    (':password',               $password);
                        $stmt->bindParam    (':endereco',               $endereco);
                        $stmt->bindParam    (':email',                  $email);
                        $stmt->bindParam    (':contato_telefonico',     $contato_telefonico);
                        $stmt->bindParam    (':flag_permissao',         $flag_permissao);


                        // Execute the query
                        if($stmt->execute()){echo "<div class='alert alert-success'>Record was saved.</div>";}
                        else{echo "<div class='alert alert-danger'>Unable to save record.</div>";}

                    }

                    // show error
                    catch(PDOException $exception){die('ERROR: ' . $exception->getMessage());}
                }
                ?>

                <!-- html form here where the product information will be entered -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <table class='table'>
                        <tr>
                            <td></td>
                            <td><input type='hidden'    name='id_pessoa'  class='form-control' /></td>
                        </tr>
                        <tr>
                            <td>Nome</td>
                            <td><input type='text'  name='nome' class='form-control' /></td>
                        </tr>
                        <tr>
                            <td>password</td>
                            <td><input type='text'  name='password' class='form-control' /></td>
                        </tr>
                        <tr>
                            <td>Endereço</td>
                            <td><input type='text'      name='endereco'             class='form-control' /></td>
                        </tr>

                        <tr>
                            <td>email</td>
                            <td><input type='text'      name='email'                class='form-control' /></td>
                        </tr>

                        <tr>
                            <td>contato_telefonico</td>
                            <td><input type='text'      name='contato_telefonico'   class='form-control' /></td>
                        </tr>

                        <tr>
                            <td>flag_permissao</td>
                            <td>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="flag_permissao" value="0"> Administrador
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input type="radio" name="flag_permissao" value="1"> Usuario
                                    </label>
                                </div>

                            </td>
                        </tr> <!-- tr de flagPermissao -->

                        <tr>
                            <td></td>
                            <td>
                                <input type='submit' value='Save' class='btn btn-primary' />
                                <a href='pessoa_index.php' class='btn btn-danger'>Voltar</a>
                            </td>
                        </tr>
                    </table>
                </form>














                    </div> <!-- end .container -->
            </div>





        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script>feather.replace()</script>

</body>
</html>