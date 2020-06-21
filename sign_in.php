<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" charset="UTF-8">
    <link href="src/css/reset.css" rel="stylesheet" type="text/css">
    <link href="src/css/sign_in.css" rel="stylesheet" type="text/css">
    <title>Login</title>
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
        <ul><a>Log in</a></ul>
    </div>
</header>

<div class="contents">
    <div class="login-table-container">
        <form action="vaildSignin.php" method="post">
            <h5>
                Sign in for KEEN
            </h5>
            <div class="form-col">
                <label>Username:</label><br>
                <input type="text" name="user" class="form-control">
            </div>
            <div class="form-col">
                <label>Password:</label><br>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-button">
                <input type="submit" class="submit-button" value="Sign in" name="sign in">
            </div>
            <div class="register">
                New to KEEN? <a href="register.php">Create a new account!</a>
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