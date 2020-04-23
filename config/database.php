<?php
    $host           =   "localhost";
    $database       =   "db_testeWeb";
    $db_name        =   "root";
    $db_password    =   "";

    $message        =   "";

    try{
        $con = new PDO("mysql:host={$host};dbname={$database}", $db_name, $db_password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }//try
    catch(PDOException $error){$message = $error->getMessage();}
?>