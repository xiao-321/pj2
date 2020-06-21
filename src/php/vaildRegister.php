<?php
require_once('config.php');
$username = $_POST["user"];
$email = $_POST["email"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];

try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "select * from traveluser where UserName=:user";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user', $username);
    $statement->execute();
    if ($statement->rowCount() > 0) {
        $wrong_alert = 1;
    }
} catch (Exception $e) {
    echo "Error:" . $e->getMessage();
    exit;
}


if ($username != null) {
    if ($wrong_alert != null) {
        echo '<script>alert("The username has been registered！");</script>';
        header('refresh: 1; url=../register.php');
        exit;
    } else{
        $statement = null;
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $sql = "INSERT INTO traveluser(Email,UserName,Pass)VALUES(:email,:user,:password)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':user', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        header('refresh:0; url= ../sign_in.php');
    }
}
$pdo = NULL;