<?php
$str = "Tashi";
$rev = "";

for ($i = strlen($str) - 1; $i >= 0; $i--) {
    $rev .= $str[$i];
}

echo "Reversed string: $rev";
?>
