<?php
class stringFormat
{
    // 改行を取り除く
    public static function trimNewLine($string) {
        return preg_replace("/\r\n|\n|\r/", "", $string);
    }

    // 先頭末尾の空白を取り除く
    public static function trimHeadOrTailSpace($string) {
        return preg_replace("/^\s+|\s+$/", "", $string);
    }
}
