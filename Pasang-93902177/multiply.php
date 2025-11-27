<?php
$n = 5;

echo "<table border='1' cellpadding='8' style='border-collapse:collapse'>";
echo "<caption>Multiplication Table of $n</caption>";
echo "<tr><th>Multiplier</th><th>Result</th></tr>";

for ($i = 1; $i <= 10; $i++) {
    echo "<tr>";
    echo "<td>$n x $i</td>";
    echo "<td>" . ($n * $i) . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
