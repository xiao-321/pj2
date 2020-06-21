<?php
require_once('src/php/config.php');
function outputBrowse($imageid){
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $sql = "SELECT Description,Title,PATH FROM travelimage WHERE ImageID=:imageid";
        $result = $pdo->prepare($sql);
        $result -> bindValue(':imageid',$imageid);
        $result -> execute();
        $details = $result->fetch();
        $path = $details['PATH'];

        echo '
        <div class="item">
            <a href="details.php?id='.$imageid.'">
                <img src="images/square/square-medium/'.$path.'" alt="I\'m a beautiful picture">
            </a>
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
    <link href="src/css/browse_medium.css" rel="stylesheet" type="text/css">
    <script src="src/js/browse.js"></script>
    <title>Browse</title>
    <script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function change(){
            let countryMenu = document.getElementById("address");
            let cityMenu = document.getElementById("city");
            let index = countryMenu.selectedIndex;
            let country = countryMenu.options[index].value;
            cityMenu.length = 1;
            if(index !== 0){
                let request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if(request.readyState === 4 && request.status ===200){
                        let info = request.responseText.split("|");
                        //document.getElementById("test").innerText = info;
                        for(let i = 0 ;i < info.length;i++){
                            if(info[i]!== 'null'){
                                let infos = info[i].split('&')
                                let cityCode = infos[0];
                                let cityName = infos[1];
                                cityMenu[cityMenu.length] = new Option(cityName,cityCode);
                            }
                        }
                    }
                };
                request.open("GET", "address.php?country=" + country, true);
                request.send();
            }
        }
    </script>
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
                <a class="browse" href="browse_medium.php">Browse</a>
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

<div class="browse-container">
    <div class="search-bar">
        <form class="search-by-title" action="browse_medium.php" method="get">
            <label>Search by Title</label><br>
            <input type="text" name="type-in-title" class="form-control">
            <input type="submit" class="search-button" value="Go">
        </form>
        <div class="hot-search">
            <ul>
                <li>
                    <a class="hot-search-title">Hot Content</a>
                    <ul>
                        <li>
                            <a href="browse_medium.php?content=scenery" class="hot-search-content">Scenery</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?content=city" class="hot-search-content">City</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?content=people" class="hot-search-content">People</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?content=animal" class="hot-search-content">Animal</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?content=building" class="hot-search-content">Building</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?content=wonder" class="hot-search-content">Wonder</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="hot-search">
            <ul>
                <li>
                    <a class="hot-search-title">Hot Country</a>
                    <ul>
                        <li>
                            <a href="browse_medium.php?countryCode=AT" class="hot-search-content">Austria</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?countryCode=JP" class="hot-search-content">Japan</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?countryCode=CN" class="hot-search-content">China</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?countryCode=FR" class="hot-search-content">France</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="hot-search">
            <ul>
                <li>
                    <a class="hot-search-title">Hot City</a>
                    <ul>
                        <li>
                            <a href="browse_medium.php?cityCode=2643743" class="hot-search-content">London</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?cityCode=5913490" class="hot-search-content">Calgary</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?cityCode=2302357" class="hot-search-content">Cape Coast</a>
                        </li>
                        <li>
                            <a href="browse_medium.php?cityCode=3164603" class="hot-search-content">Venezia</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="filter">
        <div class="filter-bar">
            <form name="form1" action="browse_medium.php" method="get">
                <label>Filter</label><br>
                <select name="content">
                    <option value="Contents">Filter by Contents</option>
                    <option value="scenery">Scenery</option>
                    <option value="animals">Animals</option>
                    <option value="city">City</option>
                    <option value="people">People</option>
                    <option value="wonder">Wonder</option>
                    <option value="building">Building</option>
                    <option value="other">Other</option>
                </select>
                <select name="countryCode" id="address" onclick="change()">
                    <option value="Country">Filter by Country</option>
                    <?php
                    require_once('src/php/config.php');
                    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                    $sql = "SELECT Country_RegionName,ISO FROM geocountries_regions";
                    $result = $pdo -> prepare($sql);
                    $result -> execute();
                    while($stmt = $result -> fetch()){
                        $ISO = $stmt['ISO'];
                        $countryname = $stmt['Country_RegionName'];
                        echo'
                                    <option value='.$ISO.' id="address">'.$countryname.'</option>
                                ';
                    }
                    ?>
                </select>
                <select name="cityCode" id="city">
                    <option value="0">Filter by City</option>
                </select>
                <input type="submit" class="filter-button" value="Filter">
            </form>
        </div>
        <div class="storey-box">
            <div class="img-size">
                Img-size:
                <a class="img-size-big" href="browse_big.php">
                    big
                </a>
                <a class="img-size-medium" href="browse_medium.php">
                    medium
                </a>
                <a class="img-size-small" href="browse_small.php">
                    small
                </a>
            </div>

            <?php
            require_once('src/php/config.php');
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
            $searchtitle = isset($_GET['type-in-title']) ? $_GET['type-in-title'] : "";
            $searchContent = isset($_GET['content']) ? $_GET['content'] : "";
            $searchCountry = isset($_GET['countryCode']) ? $_GET['countryCode'] : "";
            $searchCity = isset($_GET['cityCode']) ? $_GET['cityCode'] : "";
            $line = 0;

            if($searchtitle!=""){//1。输入标题内容搜索
                $sql = "SELECT ImageID FROM travelimage WHERE Title LIKE :title";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':title', "%$searchtitle%");
                $stmt -> execute();
                $line = $stmt -> rowCount();
                $result = array();
                for ($j = 0; ($j < ($stmt -> rowCount())) && ($row = $stmt->fetch()); $j++ ){
                    array_push($result, $row['ImageID']);
                }
            }

            if(!isset($_GET['cityCode']) && !isset($_GET['countryCode']) && isset($_GET['content'])){
                $sql = "SELECT ImageID FROM travelimage WHERE Content = :content";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':content', "$searchContent");
                $stmt -> execute();
                $line = $stmt -> rowCount();
                $result = array();
                for ($j = 0; ($j < ($stmt -> rowCount())) && ($row = $stmt->fetch()); $j++ ){
                    array_push($result, $row['ImageID']);
                }
            }

            if(!isset($_GET['cityCode']) && isset($_GET['countryCode']) && !isset($_GET['content'])){
                $sql = "SELECT ImageID FROM travelimage WHERE Country_RegionCodeISO = :countryCode";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':countryCode', "$searchCountry");
                $stmt -> execute();
                $line = $stmt -> rowCount();
                $result = array();
                for ($j = 0; ($j < ($stmt -> rowCount())) && ($row = $stmt->fetch()); $j++ ){
                    array_push($result, $row['ImageID']);
                }
            }

            if(isset($_GET['cityCode']) && !isset($_GET['countryCode']) && !isset($_GET['content'])){
                $sql = "SELECT ImageID FROM travelimage WHERE CityCode = :cityCode";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':cityCode', "$searchCity");
                $stmt -> execute();
                $line = $stmt -> rowCount();
                $result = array();
                for ($j = 0; ($j < ($stmt -> rowCount())) && ($row = $stmt->fetch()); $j++ ){
                    array_push($result, $row['ImageID']);
                }
            }

            if(isset($_GET['cityCode']) && isset($_GET['countryCode']) && isset($_GET['content'])){
                $sql = "SELECT ImageID FROM travelimage WHERE CityCode = :cityCode and Content = :content" ;
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':cityCode', "$searchCity");
                $stmt->bindValue(':content', "$searchContent");
                $stmt -> execute();
                $line = $stmt -> rowCount();
                $result = array();
                for ($j = 0; ($j < ($stmt -> rowCount())) && ($row = $stmt->fetch()); $j++ ){
                    array_push($result, $row['ImageID']);
                }
            }


            $TotalPages = ceil($line/16);
            $pagenow = isset($_GET['page'])?$_GET['page']:1;
            $back = ($pagenow == 1) ? 1 : $pagenow - 1;
            $next = ($pagenow == $TotalPages) ? $TotalPages : $pagenow + 1;

            if($line>0) {
                echo'<div class="contents">';
                for($j = ($pagenow - 1) * 16;($j < $line) && ($j <= ($pagenow * 16)-1);$j++){
                    outputBrowse($result[$j]);
                }
                echo'</div>';
                echo '
        <div class = page>';
                echo '<a href=browse_medium.php?type-in-title='.$searchtitle.'&content='.$searchContent.'&countryCode='.$searchCountry.'&cityCode='.$searchCity.'&page=' . $back . '>previous </a>';
                $isfull = false;
                if($TotalPages <= 5){
                    for ($i = 1; $i <= $TotalPages ; $i++) {
                        if ($i == $pagenow) echo '<a href=browse_medium.php?type-in-title='.$searchtitle.'&content='.$searchContent.'&countryCode='.$searchCountry.'&cityCode='.$searchCity.'&page=' . $i . ' style = "color : #00BBFF">' . $i . '</a>';
                        else echo '<a href=browse_medium.php?type-in-title='.$searchtitle.'&content='.$searchContent.'&countryCode='.$searchCountry.'&cityCode='.$searchCity.'&page='. $i .'> '. $i .' </a>';
                    }
                }
                else{
                    for ($i = 1; $i <= 5 ; $i++) {
                        if ($i == $pagenow) echo '<a href=browse_medium.php?type-in-title='.$searchtitle.'&content='.$searchContent.'&countryCode='.$searchCountry.'&cityCode='.$searchCity.'&page=' . $i . ' style = "color : #00BBFF">' . $i . '</a>';
                        else echo '<a href=browse_medium.php?type-in-title='.$searchtitle.'&content='.$searchContent.'&countryCode='.$searchCountry.'&cityCode='.$searchCity.'&page='. $i .'> '. $i .' </a>';
                    }
                    echo '......';
                }
                echo '<a href=browse_medium.php?type-in-title='.$searchtitle.'&content='.$searchContent.'&countryCode='.$searchCountry.'&cityCode='.$searchCity.'&page=' . $next . '> next</a>';
                echo '</div>';
            }else{
                echo '<h2 style = "color:#00BBFF;float:left;padding: 50px 100px">No uploaded photos. Go to the Upload page to upload some!</h2>';
            }

            $pdo = NULL;
            ?>


        </div>
    </div>
</div>

<footer>
    <div class="copyright">
        Copyright © 2020 Lee.All rights reserved.ICP Record No.19302010006 Fudan
    </div>
</footer>
</body>
</html>