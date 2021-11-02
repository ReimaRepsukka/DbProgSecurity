<?php
session_start();
require('headers.php');
require('functions.php');

$json = json_decode(file_get_contents('php://input'));


if(isset($_SESSION['username'])){
    echo "This is user authorized info";
    exit;
}else if(!isset($json->uname)){
    header("HTTP/1.1 401");
}


$username = filter_var( $json->uname, FILTER_SANITIZE_STRING );
$passwd = filter_var( $json->pwd, FILTER_SANITIZE_STRING );


try{
    $dbcon = new PDO('mysql:host=localhost;dbname=secdb', 'root', '');
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    createTable($dbcon);
   
    $sql = "SELECT * FROM user WHERE username=? AND password=?";
    $prepared = $dbcon->prepare($sql);
    $prepared->execute(array($username, $passwd));

    foreach($prepared as $row){
        $_SESSION['username']=$row['username'];
        echo "This is user authorized info";
        exit;
    }

    header("HTTP/1.1 401");

}catch(PDOException $e){
    echo '<br>'.$e->getMessage();
}

?>