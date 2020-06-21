<?php
require_once('src/php/config.php');
function outputSearch($imageid){
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
            <div class="description">
                 '.$description.'
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
    <link href="src/css/search.css" rel="stylesheet" type="text/css">
    <title>Search</title>
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
                <a href="search.php" class="search">Search</a>
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

<div class="search-container">
    <div class="search-bar">
        <form method="get" action="search.php">
            <div class="search-form">
                <input type="radio" name="searchWay" value="search-by-title" checked>Search by Title<br>
                <div>
                    <input type="text"  name="type-in-title" class="type-in-title">
                </div>
                <input type="radio" name="searchWay" value="search-by-description">Search by Description<br>
                <div>
                    <textarea name="type-in-description" cols="5"></textarea>
                </div>
            </div>
            <div class="form-button">
                <input type="submit" id="submit-button" class="submit-button" value="Search" name="search">
            </div>
        </form>
    </div>
    <div class="search-result">
        <div class="title">Result</div>
        <?php
        require_once('src/php/config.php');
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $searchType = isset($_GET['searchWay']) ? $_GET['searchWay'] : "";
        $searchByTitle = isset($_GET['type-in-title']) ? $_GET['type-in-title'] : "";
        $searchByDescription = isset($_GET['type-in-description']) ? $_GET['type-in-description'] : "";
        $line = 0;

        if ($searchType == 'search-by-title'){
            $sql = "SELECT ImageID FROM travelimage WHERE Title LIKE :title";
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindValue(':title',"%$searchByTitle%");
            $stmt -> execute();
            $line = $stmt -> rowCount();
            $result = array();
            for ($j = 0; ($j < ($stmt -> rowCount())) && ($row = $stmt->fetch()); $j++ ){
                array_push($result, $row['ImageID']);
            }
        }elseif($searchType == 'search-by-description'){
            $sql = "SELECT ImageID FROM travelimage WHERE Description LIKE :description";
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindValue(':description',"%$searchByDescription%");
            $stmt -> execute();
            $line = $stmt -> rowCount();
            $result = array();
            for ($j = 0; ($j < ($stmt -> rowCount())) && ($row = $stmt->fetch()); $j++ ){
                array_push($result, $row['ImageID']);
            }
        }

        $TotalPages = ceil($line/5);
        $pagenow = isset($_GET['page'])?$_GET['page']:1;
        $back = ($pagenow == 1) ? 1 : $pagenow - 1;
        $next = ($pagenow == $TotalPages) ? $TotalPages : $pagenow + 1;

        if($line>0) {
            for($j = ($pagenow - 1) * 5;($j < $line) && ($j <= ($pagenow * 5)-1);$j++){
                outputSearch($result[$j]);
            }
            echo '
        <div class = page>';
            echo '<a href=search.php?searchWay='.$searchType.'&type-in-title='.$searchByTitle.'&type-in-description='.$searchByDescription.'&page=' . $back . '>previous </a>';
            $isfull = false;
            if($TotalPages <= 5){
                for ($i = 1; $i <= $TotalPages ; $i++) {
                    if ($i == $pagenow) echo '<a href=search.php?searchWay='.$searchType.'&type-in-title='.$searchByTitle.'&type-in-description='.$searchByDescription.'&page=' . $i . ' style = "color : #00BBFF">' . $i . '</a>';
                    else echo '<a href=search.php?searchWay='.$searchType.'&type-in-title='.$searchByTitle.'&type-in-description='.$searchByDescription.'&page='. $i .'> '. $i .' </a>';
                }
            }
            else{
                for ($i = 1; $i <= 5 ; $i++) {
                    if ($i == $pagenow) echo '<a href=search.php?searchWay='.$searchType.'&type-in-title='.$searchByTitle.'&type-in-description='.$searchByDescription.'&page=' . $i . ' style = "color : #00BBFF">' . $i . '</a>';
                    else echo '<a href=search.php?searchWay='.$searchType.'&type-in-title='.$searchByTitle.'&type-in-description='.$searchByDescription.'&page='. $i .'> '. $i .' </a>';
                }
                echo '......';
            }
            echo '<a href=search.php?searchWay='.$searchType.'&type-in-title='.$searchByTitle.'&type-in-description='.$searchByDescription.'&page=' . $next . '> next</a>';
            echo '</div>';
        }else{
            echo '<h2 style = "color:#00BBFF;float:left;padding: 50px 100px">No search result. Go to the Upload page to upload some by yourself!</h2>';
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