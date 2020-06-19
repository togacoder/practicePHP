<?php
require_once("./phpQuery-onefile.php");
require_once("./stringFormat.php");

const HATENA_URL = "https://hatenablog.com/";
const HATENA_TITLE_CLASS_NAME = ".serviceTop-entry-title";
const GIGAZIN_URL = "https://gigazine.net/";
const GIGAZIN_TITLE_CLASS_NAME = "h2";

// main
function main() {
    //$phpQueryObj = getPhpQueryObj(HATENA_URL);
    //$titleArray = getTitleAndURL($phpQueryObj, HATENA_TITLE_CLASS_NAME);
    $phpQueryObj = getPhpQueryObj(GIGAZIN_URL);
    $titleArray = getTitleAndURL($phpQueryObj, GIGAZIN_TITLE_CLASS_NAME);
    $opts = getopt("a");
    $opt_flags["a"] = $opts["a"] === false ? true : false;
    if ($opt_flags["a"]) {
        viewTitleAndURL($titleArray);
    } else {
        viewOneTitleAndURL($titleArray);
    }
}

// タイトルとURLを全て表示する
function viewTitleAndURL($titleArray) {
    foreach ($titleArray as $value => $key) {
        echo $value . "\n";
        echo $key[0] . "\n";
        echo $key[1] . "\n";
        echo "----------------------------\n\n";
    }
}

// タイトルとURLを１件表示する。
function viewOneTitleAndURL($titleArray) {
    $max_size = count($titleArray);
    $index = rand(0, $max_size);
    echo $titleArray[$index][0] . "\n";
    echo $titleArray[$index][1] . "\n";
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
