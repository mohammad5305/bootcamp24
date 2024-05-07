<html>
 <head>
    <title>PHP-Test</title>
    <link rel="stylesheet" href="styles.css">
 </head>
 <body>
  <?php
    echo "<h1>Random Data</h1>";
    $dbconn = pg_connect("host=database dbname=hugedata user=postgres password=password");
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 20;
    $skip = isset($_GET['page']) ? $_GET['page']*$limit : 0;
    $columns = array("id_number","name", "phone_number");

    $conditions = array();
    foreach ($columns as $column) {
        if (isset($_GET[$column]) && ! empty($_GET[$column])) {
            array_push($conditions, sprintf("%s=%s", $column, pg_escape_literal($_GET[$column])));
        }
    }
    $query = count($conditions) > 0 ? sprintf('SELECT * FROM people WHERE %s ORDER BY id_number LIMIT $1 OFFSET $2', join(" AND ", $conditions)) : 'SELECT * FROM people ORDER BY id_number LIMIT $1 OFFSET $2';

    $result = pg_query_params($dbconn, $query, array($limit, $skip));

    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        print_r($line);
        echo "<hr/>";
    }
    echo sprintf("<a href='/?page=%s&limit=%s'><button>Next page</button></a>", (int)$_GET['page'] + 1, $limit);
    echo sprintf("<a href='/?page=%s&limit=%s'><button>Previos page</button></a>", (int)$_GET['page'] - 1, $limit);

    // Free resultset
    pg_free_result($result);

    // Closing connection
    pg_close($dbconn);

?>
 </body>
 
</html>
