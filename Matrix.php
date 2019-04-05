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

    function encrypt($word, $key)
    {
        $cipher = strtoupper(trim(""));
        $lenWord = strlen($word);
        $lenKey = strlen($key);

        $rows = round($lenWord / $lenKey +  1);

        for ($i = 0; $i < $rows; $i++)
            for ($j = 0; $j < $lenKey; $j++) {
                //$helperK = substr($key, $j, 1);

                $nextI = $i * $lenKey + substr($key, $j, 1) -1;
                $helperW = substr($word ,$nextI, 1);
                if ($nextI < $lenWord) {
                    $cipher .= substr($word ,$nextI, 1);
                }
            }
        return $cipher;
    }
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