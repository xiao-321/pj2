<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="src/css/reset.css" rel="stylesheet" type="text/css">
    <link href="src/css/index.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $.ajax({
            async: true,
            type: 'POST',
            url:'outputRandomImage.php',
            success:function (data) {
                $('#contents').html(data);
            }
        });
    </script>
    <title> KEEN —— keen on the beauty around us！</title>
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
                <a class="home" href="index.php">Home</a>
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

<div class="first-screen">
    <div class="welcome">WELCOME TO KEEN!</div>
    <div class="explanation">A website for you to share travelling photos</div>
    <div class="meaning">KEEN on the beauty around us</div>
</div>

<div class="storey-box">
    <div class="title">Recommendation</div>
    <div id="contents" class="contents">

    </div>
    <div class="discover">
        <a href="search.php">Discover more</a>
    </div>
</div>

<div class="ornament">
    <div>
        <a href="#top"><img src="images/home/top.png" alt="top"></a>
        <a href="index_refresh.php" id="refresh"><img src="images/home/refresh.png" alt="refresh"></a>
    </div>
</div>

<footer>
    <div class="instructions">
        <div class="col">
            <ul>
                <li>
                    About us
                </li>
                <li>
                    Privacy Policy
                </li>
                <li>
                    Terms of Use
                </li>
            </ul>
        </div>
        <div class="col">
            <ul>
                <li>
                    FAQs
                </li>
                <li>
                    Contact
                </li>
            </ul>
        </div>
        <img id="vx" src="images/home/vx.jpg" alt="vx">
    </div>
    <div class="copyright">
        Copyright © 2020 Lee.All rights reserved.ICP Record No.19302010006 Fudan
    </div>
</footer>
</body>
</html>