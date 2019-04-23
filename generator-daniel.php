<?php
/**
 * Created by PhpStorm.
 * User: Aneta
 * Date: 09.04.2019
 * Time: 20:16
 */
function generator($input, $number, $to_encrypt){
    $polynomial = $input;
    echo $polynomial."<Br>";
    $ziarno = array();
   
    for($i = 0; $i < $number ; $i++){
        $ostatni = substr($polynomial, -1, 1);
        $przedostatni = substr($polynomial, -2, 1);
        $ziarno[$i] = $ostatni;
        if(isset($polynomial[$i - 1])){
            $polynomial[$i] = $polynomial[$i - 1];
        }
        (int)$ostatni ^= (int)$przedostatni;
        $polynomial = substr($polynomial, 0 ,-1);
        $polynomial = $ostatni . $polynomial;
        echo $polynomial."<br>";
    }
    echo "<br>";
    foreach($ziarno as $key){
        echo $key;
    }
    echo " - Ziarno<br>".$to_encrypt." - Do zakodowania";
    for($i=0 ; $i < count($ziarno); $i++){
        (int)$last_xor[$i] = (int)$ziarno[$i] ^ (int)$to_encrypt[$i];
    }
    echo "<br>";
    foreach($last_xor as $key){
        echo $key;
    }
    echo " - Zakodowane";
}
    generator($_POST['input'], $_POST['number'], $_POST['to_encrypt']);
echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';

