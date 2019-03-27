<?php

function kodowanie($tekst, $linie)
{
    $tekstZakodowany = wiadomoscKodowa($tekst, $linie);

    $tekstFinalny = "";

    foreach($tekstZakodowany as $fragment) {
        $tekstFinalny .= $fragment;
    }

    return $tekstFinalny;
}

function odkodowanie($tekst, $linie)
{
    $dlugosc = wiadomoscKodowa($tekst, $linie);

    $odwroconaTablica = array();

    $wiadomosc = $tekst;
    for($i=0; $i<count($dlugosc); $i++) {
        $dlugosc = strlen($dlugosc[$i]);

        $odwroconaTablica[] = substr($wiadomosc, 0, $dlugosc);
        $wiadomosc = substr($wiadomosc, $dlugosc);
    }

    $tekstOdkodowany = "";

    $k=0;
    $kierunek = "naprzod";
    for($i=0;$i<strlen($tekst);$i++) {
        $aktualnaLitera = $odwroconaTablica[$k][0];
        $tekstOdkodowany .= $aktualnaLitera;
        $odwroconaTablica[$k] = substr($odwroconaTablica[$k], 1);

        if($k == 0) {
            $k++;
            $kierunek = "naprzod";
        }elseif($k == $linie-1) {
            $k--;
            $kierunek = "wstecz";
        }elseif($kierunek == "naprzod") {
            $k++;
        }elseif($kierunek == "wstecz") {
            $k--;
        }
    }

    return $tekstOdkodowany;

}

function wiadomoscKodowa($tekst, $linie)
{
    $tekstZakodowany = array();

    $a=0;
    $kierunek = "naprzod";

    for($i=0;$i<strlen($tekst);$i++) {

        $aktualnaLitera = $tekst[$i];

        if(!isset($tekstZakodowany[$a])) {
            $tekstZakodowany[$a] = "";
        }
        $tekstZakodowany[$a] .= $aktualnaLitera;

        if($a == 0) {
            $a++;
            $kierunek = "naprzod";
        }elseif($a == $linie-1) {
            $a--;
            $kierunek = "wstecz";
        }elseif($kierunek == "naprzod") {
            $a++;
        }elseif($kierunek == "wstecz") {
            $a--;
        }

    }

    return $tekstZakodowany;
}
?>

<body>
    <form method="GET" action="kodowanie.php">
        <b>Wpisz tekst: </b>
        <input type="text" name="wiadomosc" /><br />
        <b>Wpisz ilość linii: </b>
        <input type="text" name="linie" /><br />
        <input type="submit" name="submit" value="kodowanie" />
    </form>
    <form method="GET" action="odkodowanie.php">
        <b>Wpisz tekst: </b>
        <input type="text" name="wiadomosc" /><br />
        <b>Wpisz ilość linii: </b>
        <input type="text" name="linie" /><br />
        <input type="submit" name="submit" value="odkodowanie" />
    </form>
</body>