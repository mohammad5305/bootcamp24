<html>
 <head>
    <title>Search data</title>
    <link rel="stylesheet" href="styles.css">
 </head>
 <body>
  <?php
    echo "<h1><a href='/'>Random Data</a></h1>";
    $dbconn = pg_connect("host=database dbname=hugedata user=postgres password=password");
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 20;
    $skip = isset($_GET['page']) ? $_GET['page']*$limit : 0;
    $columns = array("id_number","name", "phone_number");
    echo "<form id='form_search'>";
    $conditions = array();
    foreach ($columns as $column) {
        echo "<input type='text' name=\"$column\" class='search' placeholder=\"$column\">";

        if (isset($_GET[$column]) && ! empty($_GET[$column])) {
            array_push($conditions, sprintf("%s=%s", $column, pg_escape_literal($_GET[$column])));
        }
    }
    echo "<button type='submit' onclick='on_click(self)'>Submit</button>";
    echo "</form><br/>";
    $query = count($conditions) > 0 ? sprintf('SELECT * FROM people WHERE %s ORDER BY id_number LIMIT $1 OFFSET $2', join(" AND ", $conditions)) : 'SELECT * FROM people ORDER BY id_number LIMIT $1 OFFSET $2';

    $result = pg_query_params($dbconn, $query, array($limit, $skip));

    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        print_r($line);
        echo "<hr/>";
    }

    $params = "";

    foreach ($_GET as $key => $value) {
        if ($key != "page") {
            $params .= "&$key=$value";
        }
    }
    echo "<div class='btns'>";
    echo sprintf("<a href='/?page=%s%s'><button>Previos page</button></a>", (int)$_GET['page'] > 0 ? (int)$_GET['page'] - 1 : 0, $params);
    echo sprintf("<a href='/?page=%s%s'><button>Next page</button></a>", (int)$_GET['page'] + 1, $params);
    echo "</div>";

    pg_close($dbconn);

?>
 </body>
 
</html>
