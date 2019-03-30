<?php
if(!(isset($_POST['encode_offset']) && isset($_POST['encode_text']) || (isset($_POST['decode_offset']) && isset($_POST['decode_text'])))){
    echo "Brak parametrów!";
}else{
    function szyfrowanie($tekst, $przesuniecie) {
        $szyfrowanyTekst = "";
        $przesuniecie = $przesuniecie % 26;
        if($przesuniecie < 0) {
            $przesuniecie += 26;
        }
        $i = 0;
        while($i < strlen($tekst)) {
            $c = strtoupper($tekst{$i}); 
            if(($c >= "A") && ($c <= 'Z')) {
                if((ord($c) + $przesuniecie) > ord("Z")) {
                    $szyfrowanyTekst .= chr(ord($c) + $przesuniecie - 26);
            } else {
                $szyfrowanyTekst .= chr(ord($c) + $przesuniecie);
            }
          } else {
              $szyfrowanyTekst .= " ";
          }
          $i++;
        }
        return $szyfrowanyTekst;
    }
    function odszyfrowanie($tekst, $przesuniecie) {
        $odszyfrowanyTekst = "";
        $przesuniecie = $przesuniecie % 26;
        if($przesuniecie < 0) {
            $przesuniecie += 26;
        }
        $i = 0;
        while($i < strlen($tekst)) {
            $c = strtoupper($tekst{$i}); 
            if(($c >= "A") && ($c <= 'Z')) {
                if((ord($c) - $przesuniecie) < ord("A")) {
                    $odszyfrowanyTekst .= chr(ord($c) - $przesuniecie + 26);
                } else {
                    $odszyfrowanyTekst .= chr(ord($c) - $przesuniecie);
                }
            } else {
              $odszyfrowanyTekst .= " ";
            }
          $i++;
        }
        return $odszyfrowanyTekst;
    }

    if(!(isset($_POST['encode_text']) && isset($_POST['encode_offset']))){        
    }else{
        $zmienna = szyfrowanie($_POST['encode_text'], $_POST['encode_offset']);
        echo $zmienna;
    }
    
    if(!(isset($_POST['decode_text']) && isset($_POST['decode_offset']))){
    }else{
        $zmienna1 = odszyfrowanie($_POST['decode_text'], $_POST['decode_offset']); 
        echo $zmienna1;
    }
    echo '<br /><a href="index.php">Powrót</a>';
}
?>