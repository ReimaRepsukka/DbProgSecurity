<?php
require('headers.php');
require('functions.php');


try{
    $dbcon = new PDO('mysql:host=localhost;dbname=secdb', 'root', '');
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    createTable($dbcon);


}catch(PDOException $e){
    echo '<br>'.$e->getMessage();
}

?>