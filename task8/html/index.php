<html>
 <head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
 </head>
 <body>
<?php 
session_start();
if (! isset($_SESSION["name"])) {
    header('location: login.php');
}

echo "welecome ". $_SESSION["name"];
?>
<br/>

<button><a href="/logout.php">logout</a></button>
 
</body>
 
</html>
