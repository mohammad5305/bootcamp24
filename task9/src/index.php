<!DOCTYPE html>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Sample data</title>
  <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
</head>

<body>

<?php 
require_once 'vendor/autoload.php';
require_once 'init_db.php';
?>


<h1>Summary</h1>
<div hx-get="/data.php" hx-trigger="load, every 2s "></div><br/>
<button><a href="/reset.php">Renew</a></button>
</body>
</html>
