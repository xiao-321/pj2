<?php
header("Content-type: text/html; charset=utf-8");
require_once("src/php/config.php");
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "select * from traveluser where UserName=:user and Pass=:pass";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user', $_POST['user']);
    $statement->bindValue(':pass', $_POST['password']);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);


    if ($statement->rowCount() > 0) {
        setcookie("username", $_POST['user'], time()+60*60*24);
        setcookie("userID", $result['UID'], time()+60*60*24);
        echo '<script>alert("Welcome!");</script>';
        header('refresh: 1; url = index.php');
    } else {
        echo '<script>alert("Incorrect username or password.");</script>';
        header('refresh: 1; url = sign_in.php');
    }
}catch (PDOException $e){
    die($e -> getMessage());
}
$pdo=null;
?>

