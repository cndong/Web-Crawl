<?php
function getContent($url) {
    $curlHandler = curl_init();
    curl_setopt($curlHandler, CURLOPT_URL, $url);
    curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlHandler, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $content = curl_exec($curlHandler);
    curl_close($curlHandler);
    return $content;
}

function urlBuilder($baseUrl, $page) {
    if (strpos($baseUrl, '?') === false) {
        $parts = parse_url($baseUrl);
        $baseUrl = $parts['scheme'] . '://' . $parts['host'] . $parts['path'] . '?';
    }
    return trim(str_replace('?', '?' . $page . '&', $baseUrl), '&');
}

function extractObjects($baseUrl, $pageIterator, $xPathQuery, $className) {
    $objects = array();
    foreach ($pageIterator as $page) {
        $url = urlBuilder($baseUrl, $page);
        $domDocument = new DOMDocument();
        $domDocument->loadHTML(getContent($url));
        $domXPath = new DOMXPath($domDocument);
        $length = count(explode('|', $xPathQuery));
        $i = 0;
        foreach ($domXPath->query($xPathQuery) as $element) {
            $data[] = trim($element->nodeValue);
            $i++;
            if ($i % $length == 0) {
                $objects[] = new $className($data);
                $data = array();
            }
        }
    }
    return $objects;
}