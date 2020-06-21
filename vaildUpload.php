<?php
require_once("src/php/config.php");
header("Content-Type: text/html;charset=utf-8");
$pdo = new mysqli('localhost','19302010006','lxw20010429','travel');
$path = $_POST['file'];
$title = $_POST['title'];
$country = $_POST['countryCode'];
$city = $_POST['cityCode'];
$content = $_POST['content'];
$description = $_POST['description'];

$sql = "select max(ImageID) from travelimage";
$result = $pdo->query($sql);
$row = $result->fetch_row();//获取当前最大id值
$imageID = $row[0] + 1;//ImageID

$sql2 = "SELECT * FROM traveluser where UserName = '$_COOKIE[username]'";
$result2 = $pdo->query($sql2);
$row2 = $result2->fetch_row();
$UID = $row2[0];

$sql3 = "select ISO from geocountries_regions where Country_RegionName = '$country'";
$result3 = $pdo->query($sql3);
$row3 = $result3->fetch_row();
$countryISO = $row3[0];

$sql4 = "select GEONameID from geocities where AsciiName = '$city'";
$result4 = $pdo->query($sql3);
$row4 = $result4->fetch_row();
$cityCode = $row4[0];

$sql_insert = "INSERT INTO travelimage (ImageID,Title,Description,CityCode,Country_RegionCodeISO,UID,PATH,Content) VALUES ('$imageID', '$title', '$description', '$cityCode', '$countryISO', '$UID', '$path', '$content')";
$res_insert = $pdo->query($sql_insert);

if ($res_insert) {
    echo "<script>alert('Insert successfully.');</script>";
    echo '<script>window.location="my_photo.php";</script>';
} else {
    echo "<script>alert('Insert unsuccessfully.');</script>";
}

$pdo=null;
?>