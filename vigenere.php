<?php
if(!(isset($_POST['encode_password']) && isset($_POST['encode_text']) || (isset($_POST['decode_password']) && isset($_POST['decode_text'])))){
    echo "Brak parametrów!";
}else{
    function encrypt($pswd, $text)
    {
        $pswd = strtolower($pswd);
        $code = "";
        $ki = 0;
        $kl = strlen($pswd);
        $length = strlen($text);

        for ($i = 0; $i < $length; $i++)
        {
            if (ctype_alpha($text[$i]))
            {
                if (ctype_upper($text[$i]))
                {
                    $text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("A")) % 26) + ord("A"));
                }
                else
                {
                    $text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("a")) % 26) + ord("a"));
                }
                $ki++;
                if ($ki >= $kl)
                {
                    $ki = 0;
                }
            }
        }
        return $text;
    }
    function decrypt($pswd, $text)
    {
        $pswd = strtolower($pswd);
        $code = "";
        $ki = 0;
        $kl = strlen($pswd);
        $length = strlen($text);

        for ($i = 0; $i < $length; $i++)
        {
            if (ctype_alpha($text[$i]))
            {
                if (ctype_upper($text[$i]))
                {
                    $x = (ord($text[$i]) - ord("A")) - (ord($pswd[$ki]) - ord("a"));

                    if ($x < 0)
                    {
                        $x += 26;
                    }

                    $x = $x + ord("A");

                    $text[$i] = chr($x);
                }
                else
                {
                    $x = (ord($text[$i]) - ord("a")) - (ord($pswd[$ki]) - ord("a"));

                    if ($x < 0)
                    {
                        $x += 26;
                    }

                    $x = $x + ord("a");
                    $text[$i] = chr($x);
                }
                $ki++;
                if ($ki >= $kl)
                {
                        $ki = 0;
                }
            }
        }
        return $text;
    }

    if(!(isset($_POST['encode_text']) && isset($_POST['encode_password']))){        
    }else{
        $zmienna = encrypt($_POST['encode_password'], $_POST['encode_text']);
        echo $zmienna;
    }
    
    if(!(isset($_POST['decode_text']) && isset($_POST['decode_password']))){
    }else{
        $zmienna1 = decrypt($_POST['decode_password'], $_POST['decode_text']); 
        echo $zmienna1;
    }
    echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';
}
?>

