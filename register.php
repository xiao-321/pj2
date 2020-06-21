<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="src/css/reset.css" rel="stylesheet" type="text/css">
    <link href="src/css/register.css" rel="stylesheet" type="text/css">
    <script>
        function validRegister() {
            var password = document.getElementById("password").value;
            var repassword = document.getElementById("repassword").value;
            if(password === repassword)
            {document.getElementById("submit-button").disabled = false;
            }
            else {
                alert("Password and repassword are not the same.");
                document.getElementById("submit-button").disabled = true;
            }
        }
    </script>
    <title>Register</title>
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
        <ul><a>Sign up</a></ul>
    </div>
</header>

<div class="contents">
    <div class="register-table-container">
        <form action="src/php/vaildRegister.php" method="post">
            <h5>
                Sign up for KEEN
            </h5>
            <div class="form-col">
                <label>Username(consists of letters、numbers and _):</label><br>
                <input type="text" name="user" class="form-control" pattern="^\w+$" required>
            </div>
            <div class="form-col">
                <label>Email:</label><br>
                <input type="email" name="email" class="form-control" pattern="^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$" required>
            </div>
            <div class="form-col">
                <label>Password（consists of letters and numbers, at least 8 digits）:</label><br>
                <input type="password" id="password" name="password" class="form-control" pattern="^[A-Za-z0-9]{8,}$" required >
            </div>
            <div class="form-col">
                <label>Confirm Your Password:</label><br>
                <input type="password" id="repassword" name="repassword" class="form-control" pattern="^[A-Za-z0-9]{8,}$" required onblur="validRegister()">
            </div>
            <div class="form-button">
                <input type="submit" id="submit-button"" class="submit-button" value="Sign up" name="sign up">
            </div>
        </form>
    </div>
</div>
<footer>
    <div class="copyright">
        Copyright © 2020 Lee.All rights reserved.ICP Record No.19302010006 Fudan
    </div>
</footer>
</body>
</html>