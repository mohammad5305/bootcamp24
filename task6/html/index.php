<html>
 <head>
    <title>PHP-Test</title>
    <link rel="stylesheet" href="styles.css">
 </head>
 <body>
  <?php
    include 'header.php';
    require 'db.php';
    $db = new SQLite3('blog.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

    $query = $db->query("SELECT * FROM blogs");

    while ($row = $query->fetchArray(SQLITE3_ASSOC)){
        $title = $row['title'];
        $time = date_format(date_create($row['time']),"Y-m-d");
        $content = $row['content'];

        $html = <<<HTML
        <div class="post">
            <h2 class="title">$title</h2>
            <span class="date">$time</span>
            <div class="break"></div>
            <p class="content">$content</p>
        </div>
        <hr/>
HTML;

        echo "$html";
    }
    $db->close();
?>
<div class="post">
    <h2 class="title">Title</h2>
    <span class="date">2023-11-24</span>
    <div class="break"></div>
    <p class="content">content...</p>
</div>
 </body>
 
</html>
