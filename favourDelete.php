<?php
require_once('src/php/config.php');
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "DELETE from travelimagefavor where UID=:uid and ImageID=:imageID";
    $statement = $pdo->prepare($sql);
    $statement -> bindValue(':uid',$_COOKIE['userID']);
    $statement -> bindValue(':imageID',$_GET['picture']);
    $statement->execute();
    echo '<script>alert("Delete from Favor successfully");</script>';
    header('refresh: 0; url = favour.php?page=1');
} catch (Exception $e) {
    echo "Error:" . $e->getMessage();
    exit;
}