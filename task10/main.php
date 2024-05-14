<?php
define("BASE_URL", "https://www.yjc.ir");


function is_prsident($html) {
    return str_contains($html, 'رئیس‌جمهور') || str_contains($html, 'رئیس جمهور');
}

function get_all_links($html){
    $dom = new DOMDocument('3.0');
    $dom->loadHTML($html, LIBXML_NOERROR);
    $links = array();
    foreach($dom->getElementsByTagName('div') as $node) {
        if ($node->getAttribute('class') == 'cat_item'){
            foreach ($node->childNodes as $childNode)
            {
                if ($childNode->nodeName == "a") {
                    array_push($links, $childNode->getAttribute('href'));
                }
            }
        }
    }

    return $links;
}

function get_html($url){
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($handle, CURLOPT_FAILONERROR, 1);
    curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 1);

    $response = curl_exec($handle);

    curl_close($handle);

    return $response;
}


$result = array();
for ($page = 1; $page <= 100; $page++) {
    $links = get_all_links(get_html(BASE_URL . '/fa/allnews?page='.$page));
    echo $page."\n";
    if (count($links) >= 0) {
        foreach ($links as $link){
            $html = get_html(BASE_URL . $link); 
            $dom = new DOMDocument('3.0', 'UTF-8');
            $head = '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>';
            $dom->loadHTML($head . $html, LIBXML_NOERROR);
            $finder = new DomXPath($dom);

            $title = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'title-news')]")[0]->nodeValue;
            $body = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'baznashr-body')]")[0]->nodeValue;
            $date = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'date-color-news')]")[0]->nodeValue;

            if (is_prsident($title) || is_prsident($body)) {
                echo BASE_URL . $link . "\n";

                # TODO: str_word_count didn't work
                # TODO: also counts js functions
                echo count(preg_split('/\s+/', $body)) . "\n";
                array_push($result, ['title' => trim($title), 'word_count' => count(preg_split('/\s+/', $body)), 'publish_date' => $date, 'url' => BASE_URL . $link ]);
            }

        }
    }
    else {
        break;
    }
}
$fp = fopen('./test.csv', 'w'); 
  
fputcsv($fp, array_keys($result[0]));

foreach ($result as $article) { 
    fputcsv($fp, $article); 
} 
  
fclose($fp);

echo count($result);
?>
