<?php
require_once('src/php/config.php');
function outputMy_photo($imageid){
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $sql = "SELECT Description,Title,PATH FROM travelimage WHERE ImageID=:imageid";
        $result = $pdo->prepare($sql);
        $result -> bindValue(':imageid',$imageid);
        $result -> execute();
        $details = $result->fetch();
        $description = $details['Description'];
        $title = $details['Title'];
        $path = $details['PATH'];

        echo '
        <div class="item">
            <a href="details.php?id='.$imageid.'">
                <img  alt="picture" src = "images/normal/medium/'.$path.'">
            </a>
            <div class="name">
                <a>'.$title.'</a>
            </div>
            <p class="description">
                 '.$description.'
            </p>
            <div class="button">
                <a href="upload.php?picture='.$imageid.'">Modify</a>
                <a href="my_photoDelete.php?picture='.$imageid.'">Delete</a>
            </div>
        </div>';

    }catch (Exception $e){
        echo"ERROR:".$e -> getMessage();
    }

}
$pdo = NULL;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="src/css/reset.css" rel="stylesheet" type="text/css">
    <link href="src/css/my_photo.css" rel="stylesheet" type="text/css">
    <title>My photo</title>
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

<div class="photo-container">
    <div class="photo-category">
        <ul>
            <li>
                <a class="photo-category-title">My Photo</a>
                <ul>
                    <li>
                        <a href="upload.php" class="photo-category-content">Upload new</a>
                    </li>
                    <li>
                        <a onclick="alert('Aurora')" class="photo-category-content">Aurora</a>
                    </li>
                    <li>
                        <a onclick="alert('Moon')" class="photo-category-content">Moon</a>
                    </li>
                    <li>
                        <a onclick="alert('Sunset')" class="photo-category-content">Sunset</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="storey-box">
        <?php
        require_once('src/php/config.php');
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $sql = "SELECT ImageID FROM travelimage WHERE UID =:userID";
        $stmt = $pdo -> prepare($sql);
        $stmt -> bindValue(':userID',$_COOKIE['userID']);
        $stmt -> execute();
        $line = $stmt -> rowCount();
        $result = array();
        for ($j = 0; ($j < ($stmt -> rowCount())) && ($row = $stmt->fetch()); $j++ ){
            array_push($result, $row['ImageID']);
        }

        $TotalPages = ceil($line/4);
        $pagenow = isset($_GET['page'])?$_GET['page']:1;
        $back = ($pagenow == 1) ? 1 : $pagenow - 1;
        $next = ($pagenow == $TotalPages) ? $TotalPages : $pagenow + 1;

        if($line>0) {
            for($j = ($pagenow - 1) * 4;($j < $line) && ($j <= ($pagenow * 4)-1);$j++){
                outputMy_photo($result[$j]);
            }
            echo '
        <div class = page>';
            echo '<a href=my_photo.php?page=' . $back . '>previous </a>';
            $isfull = false;
            if($TotalPages <= 5){
                for ($i = 1; $i <= $TotalPages ; $i++) {
                    if ($i == $pagenow) echo '<a href=my_photo.php?page=' . $i . ' style = "color : #00BBFF">' . $i . '</a>';
                    else echo '<a href=my_photo.php?page='. $i .'> '. $i .' </a>';
                }
            }
            else{
                for ($i = 1; $i <= 5 ; $i++) {
                    if ($i == $pagenow) echo '<a href=my_photo.php?page=' . $i . ' style = "color : #00BBFF">' . $i . '</a>';
                    else echo '<a href=my_photo.php?page='. $i .'> '. $i .' </a>';
                }
                echo '......';
            }
            echo '<a href=my_photo.php?page=' . $next . '> next</a>';
            echo '</div>';
        }else{
            echo '<h2 style = "color:#00BBFF;float:left;padding: 50px 100px">No uploaded photos. Go to the Upload page to upload some!</h2>';
        }

        $pdo = NULL;
        ?>
    </div>
</div>


<footer>
    <div class="copyright">
        Copyright © 2020 Lee.All rights reserved.ICP Record No.19302010006 Fudan
    </div>
</footer>
</body>
</html>