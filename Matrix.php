<?php
/**
 * Created by PhpStorm.
 * User: Aneta
 * Date: 03.04.2019
 * Time: 20:05
 */
if(!(isset($_POST['encode']) && isset($_POST['encode_cipher']) || (isset($_POST['decode']) && isset($_POST['decode_cipher'])))){
    echo "Brak parametrów!";
}else {

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

    function decrypt($tekst, $szyfr){

        $szyfr = str_replace("-", "", $szyfr);
        $szyfrArr = array();
        for( $i = 0; $i < strlen($szyfr) ; $i++ ){
            $szyfrArr[$i] = $szyfr[$i];  
        }
        $tekst = strtoupper($tekst); 
        $TAH = ceil(strlen($tekst)/strlen($szyfr));
        
        $tekstArr = array();
        $tekstArri = array();
        $k = 0;
        for( $i = 0 ; $i < $TAH ; $i++ ){
            for( $j = 0 ; $j < strlen($szyfr) ; $j++){
                if(!isset($tekst[$k])){
                    $tekstArr[$i][$j] = "/";
                    $k++;
                }else{
                    $tekstArr[$i][$j] = $tekst[$k];
                    $k++;
                }
            }
        }
        $m = 0;
        for( $i = 0 ; $i < $TAH ; $i++ ){
            for( $j = 0 ; $j < strlen($szyfr) ; $j++){
                if(!isset($tekstArr[$i][$j])){
                     
                }else{
                    $tekstArri[$i][$szyfrArr[$m]] = $tekstArr[$i][$j];
                }
                if(0 <= $m && $m < strlen($szyfr)-1){
                    $m++;
                }else{
                    $m = 0;
                    break;
                }
            }
        }
        $odkodowany = "";
        for( $i = 0 ; $i < $TAH ; $i++ ){
            for( $j = 0 ; $j < count($szyfrArr) ; $j++){
                if(isset($tekstArri[$i][$j])){
                    if($tekstArri[$i][$j] == "/"){
                        $odkodowany .= "";
                    }else{
                        $odkodowany .= $tekstArri[$i][$j];
                    }
                    
                }
            }
        }
        echo $odkodowany;
    }
    if(!(isset($_POST['encode']) && isset($_POST['encode_cipher']))){
    }else{
        $zmienna = encrypt($_POST['encode'], $_POST['encode_cipher']);
        echo $zmienna;
    }

    if(!(isset($_POST['decode']) && isset($_POST['decode_cipher']))){
    }else{
        $zmienna1 = decrypt($_POST['decode'], $_POST['decode_cipher']);
        echo $zmienna1;
    }
    echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';
}