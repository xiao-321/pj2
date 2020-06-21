<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="src/css/reset.css" rel="stylesheet" type="text/css">
    <link href="src/css/details.css" rel="stylesheet" type="text/css">
    <title>Details</title>
</head>

<body>
<header>
    <div class="logo">
        <a href="index.php" >
            <img src="images/logo.png" alt="logo">
        </a>
    </div>
    <div class="menu">
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="browse_medium.php">Browse</a>
            </li>
            <li>
                <a href="search.php">Search</a>
            </li>
        </ul>
    </div>
    <div class="account">
        <?php
        if(isset($_COOKIE['username'])){
            echo '
               <ul>
                    <li>
                    <a>My account</a>
                    <ul>
                      <li>
                         <a href="upload.php"><img src="images/upload.png" alt=" "> Upload</a>
                      </li>
                     <li>
                         <a href="favour.php"><img src="images/favour.png" alt=" "> My Favour</a>
                      </li>
                      <li>
                        <a href="my_photo.php"><img src="images/photo.png" alt=" "> My Photo</a>
                      </li>
                      <li>
                        <a class="login" href="logOut.php"><img src="images/login.png" alt=" "> Log out</a>
                     </li>
                    </ul>
                </li>
            </ul>';
        }else{
            echo '<ul><a href="sign_in.php">Login</a></ul>';
        }
        ?>
    </div>
</header>

<?php
require_once('src/php/config.php');
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "SELECT Description,Title,PATH,Content FROM travelimage WHERE ImageID=:imageid";
    $result = $pdo->prepare($sql);
    $result->bindValue(':imageid', $_GET['id']);
    $result->execute();
    $details = $result->fetch();
    $description = $details['Description'];
    $title = $details['Title'];
    $path = $details['PATH'];
    $content = $details['Content'];

    $sql = "SELECT Country_RegionName FROM  geocountries_regions  JOIN travelimage ON  geocountries_regions.ISO=travelimage.Country_RegionCodeISO WHERE ImageID=:imageid";
    $result = $pdo -> prepare($sql);
    $result -> bindValue(':imageid',$_GET['id']);
    $result -> execute();
    $details = $result -> fetch();
    $country = $details['Country_RegionName'];

    $sql = "SELECT AsciiName FROM  geocities JOIN travelimage ON geocities.GeoNameID =travelimage.CityCode WHERE ImageID=:imageid";
    $result = $pdo -> prepare($sql);
    $result -> bindValue(':imageid',$_GET['id']);
    $result -> execute();
    $details = $result -> fetch();
    $city = $details['AsciiName'];

    $sql = "SELECT UserName FROM  traveluser JOIN travelimage ON  traveluser.UID =travelimage.UID WHERE travelimage.ImageID=:imageid";
    $result = $pdo -> prepare($sql);
    $result -> bindValue(':imageid',$_GET['id']);
    $result -> execute();
    $details = $result -> fetch();
    $uploader = $details['UserName'];

    $sql = "SELECT UID from traveluser where UserName=:user";
    $result = $pdo->prepare($sql);
    $result -> bindValue(':user',$_COOKIE['username']);
    $result->execute();
    $uid = $result;

    $sql = "SELECT UID FROM travelimagefavor WHERE ImageID=:imageid";
    $result = $pdo -> prepare($sql);
    $result -> bindValue(':imageid',$_GET['id']);
    $result -> execute();
    $favor = $result -> rowCount();

}catch (Exception $e){
    echo"ERROR:".$e -> getMessage();
}

if($description==""){$description="No description";}
if($title==""){$title="A beautiful picture";}
if($country==""){$country="null";}
if($city==""){$city="null";}
if($uploader==""){$uploader="null";}

echo'
<div class="details-container">
    <div class="photo">
        <div class="photo-img">
            <a>
                <img src="images/normal/medium/'.$path.'" alt="picture">
            </a>
        </div>
        <div class="photo-like">
            <a onclick="alert(\'like!\')" >
                <img src="images/detail/like.png" alt="like!">
            </a>
            <a href="favorChange.php?id='.$_GET['id'].'">
                <img src="images/detail/favour.png" alt="Add to favour.">
            </a>
        </div>
        <div class="name">
            '.$title.'
        </div>
        <p class="description">
            '.$description.'
        </p>
    </div>
    <div class="info">
        <div class="info-author">
            <div class="info-basic">
                Name:'.$title.'
            </div>
            <div class="info-basic">
                Author:'.$uploader.'
            </div>
            <div class="author-subscription">
                <a onclick="alert(\'Subscribe the author.\')">+Subscribe</a>
            </div>
        </div>
        <div class="info-like">
            <div class="info-like-content">
                <div class="number">10w+</div>
                <div class="name">VIEWS</div>
            </div>
            <div class="info-like-content">
                <div class="number">100</div>
                <div class="name">LIKE</div>
            </div>
            <div class="info-like-content">
                <div class="number">'.$favor.'</div>
                <div class="name">FAVOURITE</div>
            </div>
        </div>
        <div class="info-detail">
            <ul>
                <li>
                    <div class="name">Content:</div>'.$content.'
                </li>
                <li>
                    <div class="name">Country:</div>'.$country.'
                </li>
                <li>
                    <div class="name">City:</div>'.$city.'
                </li>
            </ul>
        </div>
       
    </div>
</div>
'?>

<footer>
    <div class="copyright">
        Copyright © 2020 Lee.All rights reserved.ICP Record No.19302010006 Fudan
    </div>
</footer>
</body>
</html>