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
    $xorValue = 0;
for ($j=0; $j<10; $j++) {

    for ($i = 0; $i < $degree; $i++) {
         if($polynomial[$i + 1] == "1") {
             //$xorValue = 0 ^ 1;
            $xorValue = (int)$polynomial[$i-1] ^ (int)$polynomial[$i];
       }
    }
    echo "<br />";
    echo  $j+1 . "." . "Przed: ";
    for ($i = 0; $i < $degree; $i++) {
        echo $polynomial[$i];
    }
    echo "<br />";
    echo "XOR: " . $xorValue . "<br />";
    for ($i = $degree - 1; $i >= 1; $i--) {

        $polynomial[$i] = $polynomial[$i - 1];

    }
   $polynomial[0] = $xorValue;
    echo "Po: ";
    for ($i = 0; $i < $degree; $i++) {
        echo $polynomial[$i];
    }
    echo "<br>";
}
echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';
$a = 1;
$b = 0;
echo $a ^= $b;

