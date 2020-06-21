<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="src/css/reset.css" rel="stylesheet" type="text/css">
    <link href="src/css/upload.css" rel="stylesheet" type="text/css">
    <script src="src/js/upload.js"></script>
    <?php
    if(isset($_GET['picture'])){
        echo '<title>Modify</title>';
    }else{
        echo'<title>Upload</title>';
    }
    ?>
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
                                let infos = info[i].split('&');
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
if(isset($_GET['picture'])){
    echo '<form class="upload-bar" action="vaildModify.php?picture='.$_GET['picture'].'" method="post">';
}else{
    echo'<form class="upload-bar" action="vaildUpload.php" method="post">';
}
?>
    <div class="upload-container">
        <div class="upload-photo">
            <div class="photo-container" id="preview" style="width:650px;height:350px;">
                <?php
                if(isset($_GET['picture'])){
                    require_once("src/php/config.php");
                    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                    $sql = "SELECT PATH FROM travelimage WHERE ImageID = :imageID";
                    $statement = $pdo->prepare($sql);
                    $statement->bindValue(':imageID', $_GET['picture']);
                    $statement->execute();
                    $result = array();
                    for ($j = 0; ($j < ($statement -> rowCount())) && ($row = $statement->fetch()); $j++ ){
                        array_push($result, $row['PATH']);
                    }
                    echo '<div class="photo-container-instruction">
                               <img src="images/normal/medium/'.$result[0].'." alt="image" width="300px" height="175px">
                           </div>';
                }else{
                    echo'<div class="photo-container-instruction">
                    No uploaded photo
                    </div>';
                }
                ?>

            </div>
            <input class="input-photo" id="file" name="file" type="file" onchange="previewImage(this,650,350)" accept="image/*" required>
        </div>
        <div class="upload-detail">
            <div class="form-col">
                <label>Title:</label><br>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-col">
                <label>Country:</label><br>
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
            </div>
            <div class="form-col">
                <label>City:</label><br>
                <select name="cityCode" id="city">
                    <option value="0">Filter by City</option>
                </select>
            </div>
            <div class="form-col">
                <label>Content:</label><br>
                <select name="content">
                    <option value="Scenery">Scenery</option>
                    <option value="City">City</option>
                    <option value="Animal">Animal</option>
                    <option value="People">People</option>
                    <option value="Wonder">Wonder</option>
                    <option value="Building">Building</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-col">
                <label>Description:</label><br>
                <textarea cols="5" name="description"required></textarea>
            </div>
            <div class="form-button">
                <?php
                if(isset($_GET['picture'])){

                echo '<input type="submit" class="submit-button" value="Modify" name="Modify">';
                }else{
                echo'<input type="submit" class="submit-button" value="Upload" name="Upload">';
                }
                ?>
            </div>
        </div>
    </div>
</form>

<footer>
    <div class="copyright">
        Copyright © 2020 Lee.All rights reserved.ICP Record No.19302010006 Fudan
    </div>
</footer>

</body>
</html>