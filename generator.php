<?php
/**
 * Created by PhpStorm.
 * User: Aneta
 * Date: 09.04.2019
 * Time: 20:16
 */


$polynomial = "100011101";
$degree = strlen($polynomial) - 1;
$bits[$degree];

$seed = time(0);

    for ($i = 0; $i < $degree; $i++) {
        $bits[$i] = $seed & 1;
        $seed >>= 1;
    }
for ($j=0; $j<10; $j++) {
    $xorValue = 0;
    for ($i = 0; $i < $degree; $i++) {
        if ($polynomial[$i + 1] == "1") {
            $xorValue ^= $bits[$i];
        }
    }
    echo "<br />";
    echo  $j+1 . "." . "Przed: ";
    for ($i = 0; $i < $degree; $i++) {
        echo $bits[$i];
    }
    echo "<br />";
    echo "XOR: " . $xorValue . "<br />";
    for ($i = $degree - 1; $i >= 1; $i--) {
        $bits[$i] = $bits[$i - 1];
    }
    $bits[0] = $xorValue;
    echo "Po: ";
    for ($i = 0; $i < $degree; $i++) {
        echo $bits[$i];
    }
}
echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';

