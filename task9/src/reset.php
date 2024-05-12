<?php
    $dbconn = pg_connect("host=database dbname=hugedata user=postgres password=password");
    pg_query('DROP TABLE people');
    pg_close();
    header('location: index.php');
?>
