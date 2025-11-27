<?php
$str = "hello world";
$vowels = 0;

for ($i = 0; $i < strlen($str); $i++) {
    if (in_array(strtolower($str[$i]), ['a','e','i','o','u'])) {
        $vowels++;
    }
}

echo "Total vowels = $vowels";
?>
