<?php

mt_srand((double)microtime()*1000000);  //以時間當亂數種子
$Rand = Array(); //定義為陣列
$count = 177841 ; //共產生幾筆
for ($i = 1; $i <= $count; $i++) {
    $randval = mt_rand(1,177841); //取得範圍為1~500亂數
     if (in_array($randval, $Rand)) { //如果已產生過迴圈重跑
        $i--;
    }else{
        $Rand[] = $randval; //若無重復則 將亂數塞入陣列
    }
}
?>

