<html>
 <head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
 </head>
 <body>
 
 <form class="login" action="/login.php" method="POST">
    <h1>Login</h1>
    <input type'text' placeholder="username" name="username"><br/>
    <input type='password' placeholder="password" name="password"><br/>
    <div>
    <input type="checkbox" id="keep" name="keepin">
    <label for="keep">Remember me</label>
    </div><br/>
    <button type="submit">Submit</button>
 </form>
 </body>
 
</html>
<?php
session_start();

$username = "admin";
$password = "admin";
$token = base64_encode($username . "salt" . $password);

if (isset($_COOKIE['remember_me']) && $_COOKIE['remember_me'] == $token) {
    $_SESSION['name'] = $username;
    header('location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        if ($_POST['keepin'] == true) {
            $expire =  time() + 60 * 60 * 24 * 30;
            setcookie('remember_me', $token, $expire);
        }
        $_SESSION['name'] = $username;

        header('location: index.php');
    } else {
        header('location: login.php');
    }
}

?>
