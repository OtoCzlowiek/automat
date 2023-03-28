<?php
    $con = mysqli_connect('localhost','root','','automat4gc');
    $spcon = mysqli_connect('10.10.10.24','4gc','4gc','4gd_automat');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='automat.css'>
    <title>PRZEKĄSKI</title>
</head>
<body>
    <header>
        <h1 class='font-effect-neon'>AUTOMATO</h1>
        <h4>Pyszne przekąski na każdy dzień!</h4>
    </header>
    <main>
        <?php
            $shw = "SELECT * FROM automat;";
            $q_shw = mysqli_query($con,$shw);

            while($fa_shw = mysqli_fetch_assoc($q_shw)){
                echo "<div class='prod'>
                        <img src='".$fa_shw['id'].".png' alt='produkt: ".$fa_shw['nazwa']."'><br/>
                        <span>".$fa_shw['nazwa']." </span><label>Nr".$fa_shw['id']."<label><br/>
                        <span>".$fa_shw['cena']." PLN</span>
                        <p>Ilość pozostałych: ".$fa_shw['ilosc']."</p>
                    </div>";
            }
        ?>
    </main>
    <aside>
        <form method='get' action='#'>
            <label>Wprowadź numer produktu</label><br><input type='text' name='nrp' required><br/>
            <label>Wprowadź kwotę</label><br><input type='text' name='wk' required><br/>
            <button type='submit' name='g-k' class='font-effect-neon'>OK</button>
        </form>
        <?php
            if(array_key_exists('g-k', $_GET)){
                  //kwota wpisana
                @$kw = $_GET['wk'];
                  //wybrany produkt
                @$wyb = $_GET['nrp'];

                $kup = "SELECT * FROM automat WHERE id=$wyb";
                $q_kup = mysqli_query($con,$kup);
                $fa_kup = mysqli_fetch_assoc($q_kup);

                $akt = "UPDATE automat SET ilosc = ilosc-1 WHERE id=$wyb";

                  //zabezpieczenie przed podaniem nie-liczb
                if (!is_numeric($kw)){echo 'Kwota musi być liczbą! Grosze oddziel kropką!';}
                  //zabezpieczenie przed podaniem id innego niż od 1 do 5
                else if ($wyb>5||$wyb<1){echo 'Nie ma takiego produtu!';}
                  //zabezpieczenie przed kupieniem produktu po zbyt niskiej cenie
                else if($kw < $fa_kup['cena']) {echo 'Jesteś zbyt biedny!!!!';}
                  //zabezpieczenie przed kupieniem rzeczy, których aktualnie nie ma
                else if ($fa_kup['ilosc'] <= 0){echo 'Ten produkt nie jest teraz dostępny!!!!';}
                  //jeśli wpisana kwota jest większa lub równa cenie

                else{
                    setcookie('prod', $fa_kup['id']);

                    if($kw > $fa_kup['cena']){$re = $kw-$fa_kup['cena'];}
                    else if($kw = $fa_kup['cena']){$re = 0;}

                    setcookie('resz', $re);

                    if($fa_kup['ilosc'] == 1){
                        mysqli_query($con,$akt);
                        mysqli_query($spcon,"INSERT INTO automat VALUES (null, 'FP','".$fa_kup['nazwa']."')");
                        echo "<script>location.replace('automat.php')</script>";}
                    else {
                        mysqli_query($con,$akt);
                        echo "<script>location.replace('automat.php')</script>";}
                }
                exit();
            }
        ?>
    </aside>
    <article>
        <h3>Kupiony produkt</h3>
        <?php
            echo '<img src="./'.$_COOKIE["prod"].'.png" alt="twój produkt" title="twój produkt"><br>';

            if($_COOKIE['resz']>0){echo 'Twoja reszta: '.$_COOKIE["resz"].' PLN';}
        ?>
    </article>
    <footer>
        <a href='./login.php'><button id='long'>uzupełnianie</button></a>
    </footer>
</body>
</html>
<?php
mysqli_close($con);
mysqli_close($spcon);
?>