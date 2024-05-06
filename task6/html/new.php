<?php include 'header.php'; ?>
<?php 
echo $_SESSION['name'];
if (! isset($_SESSION['name'])) {
    header('location: login.php');
}
?>
