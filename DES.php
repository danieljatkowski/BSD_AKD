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
            //Zmienne i tablice
            $PC2 = array ( 14, 17, 11, 24, 1, 5, 3, 28, 15, 6, 21, 10, 23, 19, 12, 4, 26, 8, 16, 7, 27, 20, 13, 2, 41, 52, 31, 37, 47, 55, 30,
                40, 51, 45, 33, 48, 44, 49, 39, 56, 34, 53, 46, 42, 50, 36, 29, 32 );
            $value = unpack('h*', $tekst);
            $bin = base_convert($value[1], 16, 2);
            $lenBin = strlen($bin);
            $newBinArr = array();
            $newBinArrByIP = array();
            $IP = array(58, 50, 42, 34, 26, 18, 10, 2, 60, 52, 44, 36, 28, 20, 12, 4, 62, 54, 46, 38, 30, 22, 14, 6,
                64, 56, 48, 40, 32, 24, 16, 8, 57, 49, 41, 33, 25, 17, 9, 1, 59, 51, 43, 35, 27, 19, 11, 3,
                61, 53, 45, 37, 29, 21, 13, 5, 63, 55, 47, 39, 31, 23, 15, 7);
            $left = array();
            $right = array();
            $E = array(32, 1, 2, 3, 4, 5, 4, 5, 6, 7, 8, 9, 8, 9, 10, 11, 12, 13, 12, 13, 14, 15, 16, 17, 16, 17, 18,
                19, 20, 21, 20, 21, 22, 23, 24, 25, 24, 25, 26, 27, 28, 29, 28, 29, 30, 31, 32, 1);
            $newR = array();
            $PC = array(57, 49, 41, 33, 25, 17, 9, 1, 58, 50, 42, 34, 26, 18, 10, 2, 59, 51, 43, 35, 27, 19, 11, 3, 60, 52, 44, 36,
                63, 55, 47, 39, 31, 23, 15, 7, 62, 54, 46, 38, 30, 22, 14, 6, 61, 53, 45, 37, 29, 21, 13, 5, 28, 20, 12, 4);
            $keyToArr = array();
            $keybyPC = array();
            $C = array();
            $D = array();
            $CiDbyPC2 = array();
            $KRXor =array();
            $mainStringArr=array();
            $almostFinalArray=array();
            $s1 = array(
                0=> array(14, 4, 13, 1, 2, 15, 11, 8, 3, 10, 6, 12, 5, 9, 0, 7) ,
                1=> array( 0, 15, 7, 4, 14, 2, 13, 1, 10, 6, 12, 11, 9, 5, 3, 8) ,
                2=> array(4, 1, 14, 8, 13, 6, 2, 11, 15, 12, 9, 7, 3, 10, 5, 0) ,
                3=>array(15, 12, 8, 2, 4, 9, 1, 7, 5, 11, 3, 14, 10, 0, 6, 13 ),);
	        $s2 = array(
                0=>array(15, 1, 8, 14, 6, 11, 3, 4, 9, 7, 2, 13, 12, 0, 5, 10) ,
                1=>array(3, 13, 4, 7, 15, 2, 8, 14, 12, 0, 1, 10, 6, 9, 11, 5) ,
                2=>array(0, 14, 7, 11, 10, 4, 13, 1, 5, 8, 12, 6, 9, 3, 2, 15) ,
                3=>array(13, 8, 10, 1, 3, 15, 4, 2, 11, 6, 7, 12, 0, 5, 14, 9 ),);
	        $s3 = array(
                0=>array(10, 0, 9, 14, 6, 3, 15, 5, 1, 13, 12, 7, 11, 4, 2, 8) ,
                1=>array(13, 7, 0, 9, 3, 4, 6, 10, 2, 8, 5, 14, 12, 11, 15, 1) ,
                2=>array(13, 6, 4, 9, 8, 15, 3, 0, 11, 1, 2, 12, 5, 10, 14, 7) ,
                3=>array(1, 10, 13, 0, 6, 9, 8, 7, 4, 15, 14, 3, 11, 5, 2, 12 ),);
	        $s4= array(
                0=>array(7, 13, 14, 3, 0, 6, 9, 10, 1, 2, 8, 5, 11, 12, 4, 15) ,
                1=>array(13, 8, 11, 5, 6, 15, 0, 3, 4, 7, 2, 12, 1, 10, 14, 9) ,
                2=>array(10, 6, 9, 0, 12, 11, 7, 13, 15, 1, 3, 14, 5, 2, 8, 4) ,
                3=>array(3, 15, 0, 6, 10, 1, 13, 8, 9, 4, 5, 11, 12, 7, 2, 14 ),);
	        $s5 = array(
                0=>array(2, 12, 4, 1, 7, 10, 11, 6, 8, 5, 3, 15, 13, 0, 14, 9) ,
                1=>array(14, 11, 2, 12, 4, 7, 13, 1, 5, 0, 15, 10, 3, 9, 8, 6) ,
                2=>array(4, 2, 1, 11, 10, 13, 7, 8, 15, 9, 12, 5, 6, 3, 0, 14) ,
                3=>array(11, 8, 12, 7, 1, 14, 2, 13, 6, 15, 0, 9, 10, 4, 5, 3 ),);
	        $s6= array(
                0=>array(12, 1, 10, 15, 9, 2, 6, 8, 0, 13, 3, 4, 14, 7, 5, 11) ,
                1=>array(10, 15, 4, 2, 7, 12, 9, 5, 6, 1, 13, 14, 0, 11, 3, 8) ,
                2=>array(9, 14, 15, 5, 2, 8, 12, 3, 7, 0, 4, 10, 1, 13, 11, 6) ,
                3=>array(4, 3, 2, 12, 9, 5, 15, 10, 11, 14, 1, 7, 6, 0, 8, 13 ),);
	        $s7 = array(
	            0=>array(4, 11, 2, 14, 15, 0, 8, 13, 3, 12, 9, 7, 5, 10, 6, 1) ,
                1=>array(13, 0, 11, 7, 4, 9, 1, 10, 14, 3, 5, 12, 2, 15, 8, 6) ,
                2=>array(1, 4, 11, 13, 12, 3, 7, 14, 10, 15, 6, 8, 0, 5, 9, 2) ,
                3=>array(6, 11, 13, 8, 1, 4, 10, 7, 9, 5, 0, 15, 14, 2, 3, 12 ),);
	        $s8= array(
                0=>array(13, 2, 8, 4, 6, 15, 11, 1, 10, 9, 3, 14, 5, 0, 12, 7) ,
                1=>array(1, 15, 13, 8, 10, 3, 7, 4, 12, 5, 6, 11, 0, 14, 9, 2) ,
                2=>array(7, 11, 4, 1, 9, 12, 14, 2, 0, 6, 10, 13, 15, 3, 5, 8) ,
                3=>array(2, 1, 14, 7, 4, 10, 8, 13, 15, 12, 9, 0, 3, 5, 6, 11 ),);
            $p = array( 16, 7, 20, 21, 29, 12, 28, 17, 1, 15, 23, 26, 5, 18,
			31, 10, 2, 8, 24, 14, 32, 27, 3, 9, 19, 13, 30, 6, 22, 11, 4, 25);
            $mainStringbyP=array();
            $LnewRXor=array();
            $ip_1= array( 40, 8, 48, 16, 56, 24, 64, 32, 39, 7, 47, 15, 55,
			23, 63, 31, 38, 6, 46, 14, 54, 22, 62, 30, 37, 5, 45, 13, 53, 21,
			61, 29, 36, 4, 44, 12, 52, 20, 60, 28, 35, 3, 43, 11, 51, 19, 59,
			27, 34, 2, 42, 10, 50, 18, 58, 26, 33, 1, 41, 9, 49, 17, 57, 25 );
            $finalArray = array();

            //1.
            echo "<b>1. Tekst jawny: </b>" . $tekst . "<br />";
            echo "<b>Jego odpowiednik binarny:</b> " . $bin . "<br/>";
            if ($lenBin <= 64) {
                $newBin = str_pad($bin, 64, rand(0, 1), STR_PAD_RIGHT);
            } else
                $newBin = str_pad($bin, ($lenBin % 64), rand(0, 1), STR_PAD_RIGHT);
            echo "<b>Wyrównanie do 64 bitów: </b>" . $newBin . "<br/>";
            for ($i = 0; $i < strlen($newBin); $i++) {
                $newBinArr[$i] = $newBin[$i];
            }
            //2.
            for ($i = 0; $i < count($IP); $i++) {
                $newBinArrByIP[$i] = $newBinArr[$IP[$i] - 1];
            }
            echo "<br/>";
            echo "<b>2. Ciąg wygenerowany przy pomocy macierzy IP: </b>" . join("", $newBinArrByIP) . "<br/>";

            //3.
            for ($i = 0; $i < 32; $i++) {
                $left[$i] = $newBinArrByIP[$i];
            }
            echo "<br/>";
            echo "<b>3. L: </b>" . join("", $left) . "<br/>";
            for ($i = 32; $i < 64; $i++) {
                $right[$i - 32] = $newBinArrByIP[$i];
            }
            echo "<b>R: </b>" . join("", $right) . "<br/>";

            //8.
            for ($n = 0; $n < count($E); $n++) {
                $newR[$n] = $right[$E[$n] - 1];
            }
            echo "<br/>";
            echo "<b>8. R po transformacji z E: </b>" . join("", $newR) . "<br/>";

            //4.
            echo "<br/>";
            echo "<b>4. Klucz z pliku: </b>" . $content . "</br>";
            for ($i = 0; $i < strlen($content); $i++) {
                $keyToArr[$i] = $content[$i];
            }
            for ($n = 0; $n < count($PC); $n++) {       //tablica na zmianę kolejności
                $keybyPC[$n] = $keyToArr[$PC[$n] - 1];
            }
            echo "<b>KEYBYPC: </b>";
            foreach ($keybyPC as $key) {
                echo $key;
            }
            echo "<br>";
            echo "<br/>";

            //5.
            echo "<b>5. C: </b>";
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

            //6. i 7.
            echo "<b>6. i 7.</b><br/>";
            while ($z < 16) {
                $numer = $z + 1;
                echo $numer.". ";
                if ($z==0 || $z==1 || $z==8 || $z==15) {
                    $tmpC = array_shift($C);
                    array_push($C, $tmpC);
                    echo"<b>C: </b>";
                    foreach ($C as $keyC) {
                        echo $keyC;
                    }
                    echo "__________";
                    $tmpD = array_shift($D);
                    array_push($D, $tmpD);
                    echo "<b>D: </b>";
                    foreach ($D as $keyD) {
                        echo $keyD;
                    }
                    echo "__________";
                    $CiD=array_merge($C,$D);
                    echo "<b>CiD: </b>";
                    foreach ($CiD as $keyCiD) {
                        echo $keyCiD;
                    }
                    echo "<br/>";
                    echo "<b>KeyByPC2: </b>";
                    for ($n = 0; $n < count($PC2); $n++) {       //tablica na zmianę kolejności
                        $CiDbyPC2[$n] = $CiD[$PC2[$n] - 1];
                        echo $CiDbyPC2[$n];
                    }
                }
                else {
                    $tmpC = $C[0];
                    $tmpC1 = $C[1];
                    $tmpD = $D[0];
                    $tmpD1 = $D[1];
                    array_shift($C);
                    array_shift($C);
                    array_shift($D);
                    array_shift($D);
                    array_push($C, $tmpC);
                    array_push($C, $tmpC1);
                    array_push($D, $tmpD);
                    array_push($D, $tmpD1);
                    echo"<b>C: </b>";
                    foreach ($C as $key) {
                        echo $key;
                    }
                    echo "__________";
                    echo"<b>D: </b>";
                    foreach ($D as $keyD) {
                        echo $keyD;
                    }
                    echo "__________";
                    $CiD=array_merge($C,$D);
                    echo "<b>CiD: </b>";
                    foreach ($CiD as $keyCiD) {
                        echo $keyCiD;
                    }
                    echo "<br/>";
                    echo "<b>KeyByPC2: </b>";
                    for ($n = 0; $n < count($PC2); $n++) {       //tablica na zmianę kolejności
                        $CiDbyPC2[$n] = $CiD[$PC2[$n] - 1];
                        echo $CiDbyPC2[$n];
                    }
                }
                echo "<br>";
                $z++;
            }

            //9.
            echo "<br/>";
            for ($i=0; $i<count($CiDbyPC2); $i++) {
                $KRXor[$i]= (int)$CiDbyPC2[$i]^(int)$right[$i];
            }
            echo "<b>9. KeyKRXor: </b>";
            foreach ($KRXor as $keyKRXor) {
                echo $keyKRXor;
            }

            //10.
            echo "<br/>";
            $string1 = array_slice($KRXor, 0, 6);
            $string2 = array_slice($KRXor, 6, 6);
            $string3 = array_slice($KRXor, 12, 6);
            $string4 = array_slice($KRXor, 18, 6);
            $string5 = array_slice($KRXor, 24, 6);
            $string6 = array_slice($KRXor, 30, 6);
            $string7 = array_slice($KRXor, 36, 6);
            $string8 = array_slice($KRXor, 42, 6);
            echo "<b><br/>10. String 1: </b>";
            foreach ($string1 as $keystr1) {
                echo $keystr1;
            }
            echo "<b><br/>String 2: </b>";
            foreach ($string2 as $keystr2) {
                echo $keystr2;
            }
            echo "<b><br/>String 3: </b>";
            foreach ($string3 as $keystr3) {
                echo $keystr3;
            }
            echo "<b><br/>String 4: </b>";
            foreach ($string4 as $keystr4) {
                echo $keystr4;
            }
            echo "<b><br/>String 5: </b>";
            foreach ($string5 as $keystr5) {
                echo $keystr5;
            }
            echo "<b><br/>String 6: </b>";
            foreach ($string6 as $keystr6) {
                echo $keystr6;
            }
            echo "<b><br/>String 7: </b>";
            foreach ($string7 as $keystr7) {
                echo $keystr7;
            }
            echo "<b><br/>String 8: </b>";
            foreach ($string8 as $keystr8) {
                echo $keystr8;
            }
            echo "<br/>";
            //11., 12. i 13.
            $newI1 = bindec($string1[0]. $string1[5]);
            $newI2 = bindec($string2[0]. $string2[5]);
            $newI3 = bindec($string3[0]. $string3[5]);
            $newI4 = bindec($string4[0]. $string4[5]);
            $newI5 = bindec($string5[0]. $string5[5]);
            $newI6 = bindec($string6[0]. $string6[5]);
            $newI7 = bindec($string7[0]. $string7[5]);
            $newI8 = bindec($string8[0]. $string8[5]);

            $newJ1 = bindec($string1[1]. $string1[2]. $string1[3]. $string1[4]);
            $newJ2 = bindec($string2[1]. $string2[2]. $string2[3]. $string2[4]);
            $newJ3 = bindec($string3[1]. $string3[2]. $string3[3]. $string3[4]);
            $newJ4 = bindec($string4[1]. $string4[2]. $string4[3]. $string4[4]);
            $newJ5 = bindec($string5[1]. $string5[2]. $string5[3]. $string5[4]);
            $newJ6 = bindec($string6[1]. $string6[2]. $string6[3]. $string6[4]);
            $newJ7 = bindec($string7[1]. $string7[2]. $string7[3]. $string7[4]);
            $newJ8 = bindec($string8[1]. $string8[2]. $string8[3]. $string8[4]);

            $newString1 = sprintf("%04d", decbin($s1[(int)$newI1][(int)$newJ1]));
            $newString2 = sprintf("%04d", decbin($s2[(int)$newI2][(int)$newJ2]));
            $newString3 = sprintf("%04d", decbin($s3[(int)$newI3][(int)$newJ3]));
            $newString4 = sprintf("%04d", decbin($s4[(int)$newI4][(int)$newJ4]));
            $newString5 = sprintf("%04d", decbin($s5[(int)$newI5][(int)$newJ5]));
            $newString6 = sprintf("%04d", decbin($s6[(int)$newI6][(int)$newJ6]));
            $newString7 = sprintf("%04d", decbin($s7[(int)$newI7][(int)$newJ7]));
            $newString8 = sprintf("%04d", decbin($s8[(int)$newI8][(int)$newJ8]));
            $mainString = $newString1.$newString2.$newString3.$newString4.$newString5.$newString6.$newString7.$newString8;


            echo "<br/><b>11.,12. i 13. newString 1:</b> ".$newString1;
            echo "<br/><b>newString 2:</b> ".$newString2;
            echo "<br/><b>newString 3:</b> ".$newString3;
            echo "<br/><b>newString 4:</b> ".$newString4. "=> <b>MainString: </b>".$mainString;
            echo "<br/><b>newString 5:</b> ".$newString5;
            echo "<br/><b>newString 6:</b> ".$newString6;
            echo "<br/><b>newString 7:</b> ".$newString7;
            echo "<br/><b>newString 8:</b> ".$newString8;

            for ($i = 0; $i < strlen($mainString); $i++) {   //mainString -> mainStringArr
                $mainStringArr[$i] = $mainString[$i];
                   }

            //14.
            echo "<br/>";
            echo "<br/><b>14. MainStringbyP: </b>";
            for ($n = 0; $n < count($p); $n++) {       //tablica na zmianę kolejności
                $mainStringbyP[$n] = $mainStringArr[$p[$n] - 1];
            }
            foreach ($mainStringbyP as $keyP) {
                echo $keyP;
            }

            //15.
            echo "<br/>";
            for ($i=0; $i<count($left); $i++) {
                $LnewRXor[$i]= (int)$left[$i]^(int)$mainStringbyP[$i];
            }
            echo "<br/><b>15. LnewRXor: </b>";
            foreach ($LnewRXor as $lrxor) {
                echo $lrxor;
            }

            //16. i 17.
            echo "<br/>";
            $almostFinalArray=array_merge($LnewRXor, $right);
            echo "<br/><b>16. i 17. AlmostFinalArray:  </b>";
            foreach ($almostFinalArray as $afinal) {
                echo $afinal;
            }

            //18.
            echo "<br/>";
            echo "<br/><b>18. FinalArray:  </b>";
            for ($n = 0; $n < count($ip_1); $n++) {       //tablica na zmianę kolejności
                $finalArray[$n] = $almostFinalArray[$ip_1[$n] - 1];
                echo $finalArray[$n];
            }
            $finalString=implode("", $finalArray);


            $finalsStringASCII = '';
            for($i=0; $i<strlen($finalString); $i+=8) {
                $finalsStringASCII .= (string)chr(intval(substr($finalString, $i, 8), 2));
            }
            echo "<br/><b>Encrypted message: </b>".$finalsStringASCII;



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
