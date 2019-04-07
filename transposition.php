<?php
if(!(isset($_POST['encode']) && isset($_POST['encode_cipher']) || (isset($_POST['decode']) && isset($_POST['decode_cipher'])))){
    echo "Brak parametrów!";
}else{
    function szyfrowanie($tekst, $szyfr){

        $szyfr = str_replace("-", "", $szyfr);
        $szyfrArr = array();
        for( $i = 0; $i < strlen($szyfr) ; $i++ ){
            $szyfrArr[$i] = $szyfr[$i];  
        }

        $tekst = strtoupper(str_replace(" ", "", $tekst));
        $tekstArr = array(); 
        $TAH = ceil(strlen($tekst)/strlen($szyfr));
        $l = 0;
        for( $i = 0 ; $i < $TAH ; $i++){
            for( $j = 0 ; $j < strlen($szyfr) ; $j++){
                $tekstArr[$i][$j] = $tekst[$l];
                $l++;
                if($l == strlen($tekst)){
                    break;
                }
            }
        }

        $tekstArri = array();
        $zaszyfrowany = "";
        $k = 0;
        for( $i = 0 ; $i < $TAH ; $i++){
            for( $j = 0 ; $j < strlen($szyfr) ; $j++){
                if(isset($tekstArr[$i][$szyfrArr[$k]])){
                    $tekstArri[$i][$j] = $tekstArr[$i][$szyfrArr[$k]];
                    $zaszyfrowany .= $tekstArri[$i][$j];
                }
                
                if(0 <= $k && $k < strlen($szyfr)-1){
                    $k++;
                }else{
                    $k = 0;
                    break;
                }
            }
        }
        echo $zaszyfrowany;
    }
    function odszyfrowanie($tekst, $szyfr){

        $szyfr = str_replace("-", "", $szyfr);
        $szyfrArr = array();
        for( $i = 0; $i < strlen($szyfr) ; $i++ ){
            $szyfrArr[$i] = $szyfr[$i];  
        }
        $tekst = strtoupper(str_replace(" ", "", $tekst)); 
        $TAH = ceil(strlen($tekst)/strlen($szyfr));
        
        $tekstArr = array();
        $tekstArri = array();
        $k = 0;
        for( $i = 0 ; $i < $TAH ; $i++ ){
            for( $j = 0 ; $j < strlen($szyfr) ; $j++){
                if(isset($tekst[$k])){
                    $tekstArr[$i][$j] = $tekst[$k];
                    $k++;
                }  
            }
        }
        $m = 0;
        for( $i = 0 ; $i < $TAH ; $i++ ){
            for( $j = 0 ; $j < strlen($szyfr) ; $j++){
                if(isset($tekstArr[$i][$j])){
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
                    $odkodowany .= $tekstArri[$i][$j];
                }
            }
        }
        echo $odkodowany;
    }
    if(!(isset($_POST['encode']) && isset($_POST['encode_cipher']))){        
    }else{
        $zmienna = szyfrowanie($_POST['encode'], $_POST['encode_cipher']);
        echo $zmienna;
    }
    
    if(!(isset($_POST['decode']) && isset($_POST['decode_cipher']))){
    }else{
        $zmienna1 = odszyfrowanie($_POST['decode'], $_POST['decode_cipher']); 
        echo $zmienna1;
    }
    echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';
}
?>