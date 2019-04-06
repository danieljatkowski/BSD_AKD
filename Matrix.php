<?php
/**
 * Created by PhpStorm.
 * User: Aneta
 * Date: 03.04.2019
 * Time: 20:05
 */
if(!(isset($_POST['encode_cipher']) && isset($_POST['encode_key']) || (isset($_POST['decode_cipher']) && isset($_POST['decode_key'])))){
    echo "Brak parametrów!";
}else {

    $lenKey = strlen($key);

    function encrypt($word, $key) {
        $cipher = strtoupper(trim(""));
        $lenWord = strlen($word);
        $lenKey = strlen($key);

        if ($lenWord%$lenKey == 0) {
            $rows = $lenWord/$lenKey;
        }
        else {
            $rows = round($lenWord / $lenKey +  1);
        }


        for ($i = 0; $i < $rows; $i++)
            for ($j = 0; $j < $lenKey; $j++) {

                $nextI = $i * $lenKey + substr($key, $j, 1) -1;
                if ($nextI < $lenWord) {
                    $cipher .= substr($word ,$nextI, 1);
                }
            }
        return $cipher;
    }

    //Moj poczatek, ale wrzucimy wersje Daniela ;p
   /** function decode ($cipher, $key){
            $word = strtoupper(trim(""));
            $lenKey = strlen($key);
            $reverseKey = $lenKey, ' ';
            for ($i = 0; $i < $lenKey; $i++) {
                $helper = substr($key, $i, 1) - 1;
                $helperNew = substr($reverseKey, $helper, 1);
                $helperNew = '1' + $i;
            }
            $rows = round(strlen($cipher) / $lenKey +  1);
            for ($i =0; $i<$rows; $i++) {
                $temp = strlen($key, ' ');
            }
    }*/
    if(!(isset($_POST['encode_key']) && isset($_POST['encode_cipher']))){
    }else{
        $zmienna = encrypt($_POST['encode_cipher'], $_POST['encode_key']);
        echo $zmienna;
    }

    if(!(isset($_POST['decode_key']) && isset($_POST['decode_cipher']))){
    }else{
        $zmienna1 = decrypt($_POST['decode_cipher'], $_POST['decode_key']);
        echo $zmienna1;
    }
    echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';
}