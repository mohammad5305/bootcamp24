<?php session_start(); ?>
<link rel="stylesheet" href="styles.css">
<div class="header">
    <ul>
        <li><a href="index.php">Blog</a></li>
<?php
if (isset($_SESSION['name'])) {
    echo "<li><a href='new.php'>New</a></li>";
    echo "<li><a href='edit.php'>Edit</a></li>";
    echo "<li><a href='logout.php'>Logout</a></li>";
}
else {
    echo "<li><a href='new.php'>Login</a></li>";
}
?>

    </ul>
</div>
