<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="src/css/reset.css" rel="stylesheet" type="text/css">
    <link href="src/css/browse_small.css" rel="stylesheet" type="text/css">
    <script src="src/js/browse.js"></script>
    <title>Browse</title>
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
        <form class="search-by-title" action="#" method="post">
            <label>Search by Title</label><br>
            <input type="text" name="title" class="form-control">
            <a class="search-button" onclick="alert('search!')"><img src="images/browse/search.png" alt="search"></a>
        </form>
        <div class="hot-search">
            <ul>
                <li>
                    <a class="hot-search-title">Hot Content</a>
                    <ul>
                        <li>
                            <a onclick="alert('Aurora')" class="hot-search-content">Aurora</a>
                        </li>
                        <li>
                            <a onclick="alert('City')" class="hot-search-content">City</a>
                        </li>
                        <li>
                            <a onclick="alert('Festival')" class="hot-search-content">Festival</a>
                        </li>
                        <li>
                            <a onclick="alert('Moon')" class="hot-search-content">Moon</a>
                        </li>
                        <li>
                            <a onclick="alert('Smile')" class="hot-search-content">Smile</a>
                        </li>
                        <li>
                            <a onclick="alert('Snowy')" class="hot-search-content">Snowy</a>
                        </li>
                        <li>
                            <a onclick="alert('Sunset')" class="hot-search-content">Sunset</a>
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
                            <a onclick="alert('I love you')" class="hot-search-content">America</a>
                        </li>
                        <li>
                            <a onclick="alert('我爱你')" class="hot-search-content">China</a>
                        </li>
                        <li>
                            <a onclick="alert('Ég elska þig')" class="hot-search-content">Iceland</a>
                        </li>
                        <li>
                            <a onclick="alert('あなたを爱している')" class="hot-search-content">Japan</a>
                        </li>
                        <li>
                            <a onclick="alert('사랑해')" class="hot-search-content">Korea</a>
                        </li>
                        <li>
                            <a onclick="alert('∑\'αγαπ')" class="hot-search-content">Maldives</a>
                        </li>
                        <li>
                            <a onclick="alert('Je t\'aime、Je t\'adore')" class="hot-search-content">Paris</a>
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
                            <a onclick="alert('Welcome to Florence.')" class="hot-search-content">Florence</a>
                        </li>
                        <li>
                            <a onclick="alert('Welcome to Kyoto.')" class="hot-search-content">Kyoto</a>
                        </li>
                        <li>
                            <a onclick="alert('Welcome to New York.')" class="hot-search-content">New York</a>
                        </li>
                        <li>
                            <a onclick="alert('Welcome to Paris.')" class="hot-search-content">Paris</a>
                        </li>
                        <li>
                            <a onclick="alert('Welcome to Rio.')" class="hot-search-content">Rio</a>
                        </li>
                        <li>
                            <a onclick="alert('Welcome to Shanghai.')" class="hot-search-content">Shanghai</a>
                        </li>
                        <li>
                            <a onclick="alert('Welcome to Venice.')" class="hot-search-content">Venice</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="filter">
        <div class="filter-bar">
            <form name="form1" action="#" method="post">
                <label>Filter</label><br>
                <select name="contents">
                    <option value="Contents">Filter by Contents</option>
                    <option value="Animals">Animals</option>
                    <option value="City">City</option>
                    <option value="Landscape">Landscape</option>
                    <option value="People">People</option>
                    <option value="Wonder">Wonder</option>
                </select>
                <select name="country" onChange="set_city(this, this.form.city);">
                    <option value="Country">Filter by Country</option>
                    <option value="China">China</option>
                    <option value="Japan">Japan</option>
                    <option value="Italy">Italy</option>
                    <option value="America">America</option>
                </select>
                <select name="city" id="citys">
                    <option value="0">Filter by City</option>
                </select>
                <a onclick="alert('Filter Filter Filter')">Filter</a>
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
            <div class="contents">
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/222222.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/222223.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5855174537.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5856654945.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5855735700.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5856658791.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/9496787858.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/8152045872.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/9498358806.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5856697109.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5855729828.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/9505893300.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5855209453.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5855221959.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/6114907897.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/9496792166.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5855774224.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/8710247776.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/5856654945.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
                <div class="item">
                    <a href="details.php">
                        <img src="images/square/square-medium/9493997865.jpg" alt="I'm a beautiful picture">
                    </a>
                </div>
            </div>
            <div class="page">
                &lt; <span class="active">1</span> <a href="#">2 3 4 5 6 ... 9</a> &gt;
            </div>
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