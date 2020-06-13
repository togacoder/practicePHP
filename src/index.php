<?php
require_once("./phpQuery-onefile.php");
$html = file_get_contents("https://hatenablog.com/");
$phpQueryObj = phpQuery::newDocument($html);

$titleObj = $phpQueryObj[".serviceTop-entry-title"];

$titleAry = [];
foreach ($titleObj as $title) {
    $name = pq($title)->find('a')->text();
    $url = pq($title)->find('a')->attr('href');
    $name = preg_replace("/\r\n|\n|\r/", "", $name);
    $name = preg_replace("/^\s+|\s+$/", "", $name);
    $url = str_replace("\n", "", $url);
    $titleAry[] = [$name, $url];
}

var_dump($titleAry);
