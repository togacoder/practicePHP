<?php
class viewClass
{
     // viewの切り替えを管理
    public function viewManager($titleArray, $opt) {
        if($opt["a"] == true) {
            self::viewAllTitleAndURL($titleArray);
        } else {
            self::viewOneTitleAndURL($titleArray);
        }
    }

    // タイトルとURLを全て表示する
    private function viewAllTitleAndURL($titleArray) {
        foreach ($titleArray as $value => $key) {
            echo $value . "\n";
            echo $key[0] . "\n";
            echo $key[1] . "\n";
            echo "----------------------------\n\n";
        }
    }

    // タイトルとURLを１件表示する。
    private function viewOneTitleAndURL($titleArray) {
        $max_size = count($titleArray);
        $index = rand(0, $max_size);
        echo $titleArray[$index][0] . "\n";
        echo $titleArray[$index][1] . "\n";
    }
}
