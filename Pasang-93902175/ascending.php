<?php
$arr = array(40, 10, 50, 20, 30);
$n = count($arr);

for ($i = 0; $i < $n - 1; $i++) {
    for ($j = 0; $j < $n - $i - 1; $j++) {
        if ($arr[$j] > $arr[$j + 1]) {
            $temp = $arr[$j];
            $arr[$j] = $arr[$j + 1];
            $arr[$j + 1] = $temp;
        }
    }
}

foreach ($arr as $x) {
    echo $x . "<br>";
}
?>
