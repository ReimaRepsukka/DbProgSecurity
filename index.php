<?php
require('headers.php');
require('functions.php');

$json = json_decode(file_get_contents('php://input'));

$fname = filter_var( $json->fname, FILTER_SANITIZE_STRING );
$lname =  filter_var( $json->lname, FILTER_SANITIZE_STRING );
$username = filter_var( $json->uname, FILTER_SANITIZE_STRING );
$passwd = filter_var( $json->pwd, FILTER_SANITIZE_STRING );


try{
    $dbcon = new PDO('mysql:host=localhost;dbname=secdb', 'root', '');
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    createTable($dbcon);
   
    $sql = "INSERT INTO user VALUES(?,?,?,?)";
    $prepared = $dbcon->prepare($sql);
    $prepared->execute(array($fname, $lname, $username, $passwd));

    echo "All good";

}catch(PDOException $e){
    echo '<br>'.$e->getMessage();
}

?>