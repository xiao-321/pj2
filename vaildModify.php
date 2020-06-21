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
$imageid = $_GET['picture'];

$sql3 = "select ISO from geocountries_regions where Country_RegionName = '$country'";
$result3 = $pdo->query($sql3);
$row3 = $result3->fetch_row();
$countryISO = $row3[0];

$sql4 = "select GEONameID from geocities where AsciiName = '$city'";
$result4 = $pdo->query($sql3);
$row4 = $result4->fetch_row();
$cityCode = $row4[0];

$update = "UPDATE travelimage SET Title = '$title',Description = '$description',CityCode = '$cityCode',CountryCodeISO = '$countryISO',PATH='$path',Topic = '$content'
        WHERE ImageID = $imageid";
$result = $pdo -> prepare($update);
$result -> execute();

echo "<script>alert('Modify successfully.');</script>";
echo '<script>window.location="my_photo.php";</script>';