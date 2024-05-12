<?php
    $dbconn = pg_connect("host=database dbname=hugedata user=postgres password=password");
    $query = pg_query("SELECT 
    COUNT(CASE WHEN gender='m' THEN 1 END) AS male_count,
    COUNT(CASE WHEN gender = 'f' THEN 1 END) AS female_count, 
    COUNT(*) AS total,
    CAST(AVG(CASE WHEN gender='m' THEN age END) AS INT) AS avg_male_age,
    CAST(AVG(CASE WHEN gender='f' THEN age END) AS INT) AS avg_female_age,
    COUNT(CASE WHEN gender='f' AND age >= 60 THEN 1 END) AS female_60,
    COUNT(CASE WHEN gender='f' AND age >= 60 AND married=False THEN 1 END) AS signle_60

    FROM people");

    echo "<table style='width: 100%;text-align: center;'><tr>";
    $headers = "";
    $body = "";

    foreach (pg_fetch_array($query, null, PGSQL_ASSOC) as $key=>$value){
        $headers .= "<th>$key</th>";
        $body .= "<td>$value</td>";
    }
    echo "<tr>$headers</tr><tr>$body</tr></table>";
    pg_close();

?>

