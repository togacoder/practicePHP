<?php
require_once("./phpQuery-onefile.php");
require_once("./stringFormat.php");
require_once("./viewClass.php");

const HATENA_URL = "https://hatenablog.com/";
const HATENA_TITLE_CLASS_NAME = ".serviceTop-entry-title";
const GIGAZIN_URL = "https://gigazine.net/";
const GIGAZIN_TITLE_CLASS_NAME = "h2";

// main
function main() {
    //$titleArray = getTitleAndURL(HATENA_URL, HATENA_TITLE_CLASS_NAME);
    $titleArray = getTitleAndURL(GIGAZIN_URL, GIGAZIN_TITLE_CLASS_NAME);
    $opts = getopt("a");
    $opt_flags["a"] = $opts["a"] === false ? true : false;

    viewClass::viewManager($titleArray, $opt_flags);
}

// phpQueryオブジェクトを取得
function getPhpQueryObj($url) {
    $html = file_get_contents($url);
    return phpQuery::newDocument($html);
}

// タイトルとURLを取得
function getTitleAndURL($URL, $className) {
    $phpQueryObj = getPhpQueryObj($URL);
    $titleObj = $phpQueryObj[$className];
    $titleArray = [];
    foreach ($titleObj as $title) {
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
