<?php
require_once('src/php/config.php');
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$sql = "SELECT * from travelimagefavor where UID=:uid and ImageID=:imageID";
$statement = $pdo->prepare($sql);
$statement -> bindValue(':uid',$_COOKIE['userID']);
$statement -> bindValue(':imageID',$_GET['id']);
$statement->execute();

if($statement->rowCount() > 0) {
    $sql = "DELETE from travelimagefavor where UID=:uid and ImageID=:imageID";
    $statement = $pdo->prepare($sql);
    $statement -> bindValue(':uid',$_COOKIE['userID']);
    $statement -> bindValue(':imageID',$_GET['id']);
    $statement->execute();
    echo '<script>alert("Delete from Favor");</script>';
    echo '<script>history.go(-1)</script>';
}
else {
    $sql = "INSERT INTO travelimagefavor(UID,ImageID) VALUES(:uid,:imageID)";
    $statement = $pdo->prepare($sql);
    $statement -> bindValue(':uid',$_COOKIE['userID']);
    $statement -> bindValue(':imageID',$_GET['id']);
    $statement->execute();
    echo '<script>alert("Add to Favor");</script>';
    echo '<script>history.go(-1)</script>';
}