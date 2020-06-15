<?php
require_once("./phpQuery-onefile.php");
require_once("./stringFormat.php");

const HATENA_URL = "https://hatenablog.com/";
const HATENA_TITLE_CLASS_NAME = ".serviceTop-entry-title";
const QIITA_URL = "https://qiita.com/";

// main
function main() {
    $phpQueryObj = getPhpQueryObj(HATENA_URL);
    $titleArray = getTitleAndURL($phpQueryObj, HATENA_TITLE_CLASS_NAME);
    var_dump($titleArray);
}

// phpQueryオブジェクトを取得
function getPhpQueryObj($url) {
    $html = file_get_contents($url);
    return phpQuery::newDocument($html);
}

// タイトルとURLを取得
function getTitleAndURL($phpQueryObj, $className) {
    $titleObj = $phpQueryObj[$className];
    $titleArray = [];
    foreach($titleObj as $title) {
        $name = pq($title)->find('a')->text();
        $url = pq($title)->find('a')->attr('href');
        $name = StringFormat::trimNewLine($name);
        $name = StringFormat::trimHeadOrTailSpace($name);
        $url = StringFormat::trimNewLine($url);
        $titleArray[] = [$name, $url];
    }
    return $titleArray;
}

main();
