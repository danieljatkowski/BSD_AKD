<?php
if(!(isset($_POST['encode']) && isset($_POST['encode_rail']) || (isset($_POST['decode']) && isset($_POST['decode_rail'])))){
    echo "Brak parametrów!";
}else{
    
    function encode($text, $rails)
    {
        $codedMessage = codeMessage($text, $rails);
        $finalMessage = "";
        foreach($codedMessage as $chunks) {
            $finalMessage .= $chunks;
        }
        return $finalMessage;
    }
    function decode($text, $rails)
    {
        $lengths = codeMessage($text, $rails);
        $reversedArray = array();
        $message = $text;
        for($i=0; $i<count($lengths); $i++) {
            $length = strlen($lengths[$i]);
            $reversedArray[] = substr($message, 0, $length);
            $message = substr($message, $length);
        }
        $decodedMessage = "";
        $k=0;
        $direction = "forwards";
        for($i=0;$i<strlen($text);$i++) {
            $currentLetter = $reversedArray[$k][0];
            $decodedMessage .= $currentLetter;
            $reversedArray[$k] = substr($reversedArray[$k], 1);
            if($k == 0) {
                $k++;
                $direction = "forwards";
            }elseif($k == $rails-1) {
                $k--;
                $direction = "backwards";
            }elseif($direction == "forwards") {
                $k++;
            }elseif($direction == "backwards") {
                $k--;
            }
        }
        return $decodedMessage;
    }
    function codeMessage($text, $rails)
    {
        $codedMessage = array();
        $a=0;
        $direction = "forwards";
        for($i=0;$i<strlen($text);$i++) {
            $currentletter = $text[$i];
            if(!isset($codedMessage[$a])) {
                $codedMessage[$a] = "";
            }
            $codedMessage[$a] .= $currentletter;
            if($a == 0) {
                $a++;
                $direction = "forwards";
            }elseif($a == $rails-1) {
                $a--;
                $direction = "backwards";
            }elseif($direction == "forwards") {
                $a++;
            }elseif($direction == "backwards") {
                $a--;
            }
        }
        return $codedMessage;
    }
    if(!(isset($_POST['encode']) && isset($_POST['encode_rail']))){        
    }else{
        $zmienna = encode($_POST['encode'], $_POST['encode_rail']);
        echo $zmienna;
    }
    
    if(!(isset($_POST['decode']) && isset($_POST['decode_rail']))){
    }else{
        $zmienna1 = decode($_POST['decode'], $_POST['decode_rail']); 
        echo $zmienna1;
    }
    echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';
}
?>