<?php
/**
 * Created by PhpStorm.
 * User: Aneta
 * Date: 29.04.2019
 * Time: 17:29
 */

if($_FILES['txt']['error'] != 0){
    echo 'Error. '.$_FILES['txt']['error'];
    if ($_FILES['txt']['error'] == 4){
        echo "<br />Nie wrzuciłeś pliku .txt z kluczem";
    }
    echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';
}else {
    $content = file_get_contents($_FILES['txt']['tmp_name']);
    if(strlen($content) != 64){
        echo "<b>Klucz musi mieć 64 bity! W tym momencie ma: ". strlen($content) ."</b><br />Za 5 sekund przekieruję Cię na stronę główną.";
        echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';
    }else {


        function encryption($tekst, $content)
        {
            echo "<b>Tekst jawny: </b>" . $tekst . "<br />";
            $value = unpack('h*', $tekst);
            $bin = base_convert($value[1], 16, 2);
            $lenBin = strlen($bin);
            echo "<b>Jego odpowiednik binarny:</b> " . $bin . "<br/>";
            echo "<b>Długość odpowiednika: </b>" . $lenBin . "<br/>";
            if ($lenBin <= 64) {
                $newBin = str_pad($bin, 64, rand(0, 1), STR_PAD_RIGHT);
            } else
                $newBin = str_pad($bin, ($lenBin % 64), rand(0, 1), STR_PAD_RIGHT);
            echo "<b>Wyrównanie do 64 bitów: </b>" . $newBin . "<br/>";

            $newBinArr = array();
            for ($i = 0; $i < strlen($newBin); $i++) {
                $newBinArr[$i] = $newBin[$i];
            }

            $newBinArrByIP = array();

            $IP = array(58, 50, 42, 34, 26, 18, 10, 2, 60, 52, 44, 36, 28, 20, 12, 4, 62, 54, 46, 38, 30, 22, 14, 6,
                64, 56, 48, 40, 32, 24, 16, 8, 57, 49, 41, 33, 25, 17, 9, 1, 59, 51, 43, 35, 27, 19, 11, 3,
                61, 53, 45, 37, 29, 21, 13, 5, 63, 55, 47, 39, 31, 23, 15, 7);

            for ($i = 0; $i < count($IP); $i++) {
                $newBinArrByIP[$i] = $newBinArr[$IP[$i] - 1];
            }

            echo "<b>Ciąg wygenerowany przy pomocy macierzy IP: </b>" . join("", $newBinArrByIP) . "<br/>";

            $left = array();
            $right = array();

            for ($i = 0; $i < 32; $i++) {
                $left[$i] = $newBinArrByIP[$i];
            }
            echo "<b>L: </b>" . join("", $left) . "<br/>";

            for ($i = 32; $i < 64; $i++) {
                $right[$i - 32] = $newBinArrByIP[$i];
            }
            echo "<b>R: </b>" . join("", $right) . "<br/>";

            $E = array(32, 1, 2, 3, 4, 5, 4, 5, 6, 7, 8, 9, 8, 9, 10, 11, 12, 13, 12, 13, 14, 15, 16, 17, 16, 17, 18,
                19, 20, 21, 20, 21, 22, 23, 24, 25, 24, 25, 26, 27, 28, 29, 28, 29, 30, 31, 32, 1);
            $newR = array();

            for ($n = 0; $n < count($E); $n++) {
                $newR[$n] = $right[$E[$n] - 1];
            }
            echo "<b>R po transformacji z E: </b>" . join("", $newR) . "<br/>";

            echo "<b>Klucz: </b>" . $content . "</br>";

            $PC = array(57, 49, 41, 33, 25, 17, 9, 1, 58, 50, 42, 34, 26, 18,
                10, 2, 59, 51, 43, 35, 27, 19, 11, 3, 60, 52, 44, 36,
                63, 55, 47, 39, 31, 23, 15, 7, 62, 54, 46, 38, 30, 22,
                14, 6, 61, 53, 45, 37, 29, 21, 13, 5, 28, 20, 12, 4);
            $keyToArr = array();
            for ($i = 0; $i < strlen($content); $i++) {
                $keyToArr[$i] = $content[$i];
            }
            $keybyPC = array();
            for ($n = 0; $n < count($PC); $n++) {
                $keybyPC[$n] = $keyToArr[$PC[$n] - 1];
            }
            $C = array();
            $D = array();

            echo "<b>KEYBYPC: </b>";
            foreach ($keybyPC as $key) {
                echo $key;
            }
            echo "<br>";


            echo "<b>C: </b>";
            for ($i = 0; $i < 28; $i++) {
                $C[$i] = $keybyPC[$i];
                echo $C[$i];
            }

            echo "<br /><b>D: </b>";
            for ($i = 28; $i < 56; $i++) {
                $D[$i] = $keybyPC[$i];
                echo $D[$i];
            }

            echo "<br /> <br />";
            $z = 0;

            $PC2 = array(14, 17, 11, 24, 1, 5, 3, 28, 15, 6, 21, 10, 23, 19, 12, 4, 26, 8,
                16, 7, 27, 20, 13, 2, 41, 52, 31, 37, 47, 55, 30, 40, 51, 45, 33, 48, 44,
                49, 39, 56, 34, 53, 46, 42, 50, 36, 29, 32);

            while ($z < 16) {
                $numer = $z + 1;
                echo $numer . ". ";
                if ($z == 0 || $z == 1 || $z == 8 || $z == 15) {
                    $tempC = array_shift($C);
                    $tempD = array_shift($D);
                    $C[] = $tempC;
                    $D[] = $tempD;
                    echo "<br>C: ";
                    foreach ($C as $value) {
                        echo $value;
                    }
                    echo "<br>D: ";
                    foreach ($D as $value) {
                        echo $value;
                    }
                    $sum = array_merge($C, $D);
                    echo "<br>Połączony: ";
                    foreach ($sum as $value) {
                        echo $value;
                    }
                } else {
                    $tempC = array_shift($C);
                    $temp_secondC = array_shift($C);
                    $tempD = array_shift($D);
                    $temp_secondD = array_shift($D);
                    array_push($C, $tempC, $temp_secondC);
                    array_push($D, $tempD, $temp_secondD);
                    echo "<br>C: ";
                    foreach ($C as $value) {
                        echo $value;
                    }
                    echo "<br>D: ";
                    foreach ($D as $value) {
                        echo $value;
                    }
                    $sum = array_merge($C, $D);
                    echo "<br>Połączony: ";
                    foreach ($sum as $value) {
                        echo $value;
                    }

                }
                echo "<br>";
                $z++;
            }


            return;
        }

        if (!(isset($_POST['tekst']))) {
        } else {
            $zmienna = encryption($_POST['tekst'], $content);
            echo $zmienna;
        }

        if (!(isset($_POST['decode']) && isset($_POST['decode_cipher']))) {
        } else {
            $zmienna1 = encryption($_POST['decode'], $_POST['decode_cipher']);
            echo $zmienna1;
        }
        echo '<br /><a href="index.php" class="btn btn-primary">Powrót</a>';
    }
}
