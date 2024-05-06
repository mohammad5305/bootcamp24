<?php include 'header.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = isempty(getenv("BLOG_USERNAME")) ? getenv("BLOG_USERNAME") : "admin";
    $password = isempty(getenv("BLOG_PASSWORD")) ? getenv("BLOG_PASSWORD") : "admin";

    if ($_POST['name'] == $username && $_POST['password'] == $password) {
        $_SESSION['name'] = $username;
        header('location: new.php');
    } else {
        header('location: login.php');
    }
}
?>
<html>
 <head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
 </head>
 <body>
 <center>
    <h2>Login</h2>
     <form class="login" action="/login.php" method="POST"> 
        <input name="name" placeholder="username"><br/>
        <input type="password" name="password" placeholder="password"><br/>
        <button type="submit">Submit</button>
     </form>
 </center>
 </body>
</html>

