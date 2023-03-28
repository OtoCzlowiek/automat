<?php
    session_start();
    $con = mysqli_connect('localhost','root','','automat4gc');
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
    <?php
            $logd = mysqli_fetch_assoc(mysqli_query($con,"SELECT login, haslo FROM log;"));
            @$_SESSION['login'] = $_POST['lu'];
            @$_SESSION['haslo'] = $_POST['hu'];

            $lX = $_SESSION['login'];
            $pX = $_SESSION['haslo'];

            if($lX != $logd['login'] && $pX != $logd['haslo']){
                echo 'Niepoprawny login lub hasło';}
                
            else {echo '<main>';            
                $shw = "SELECT * FROM automat;";
                $q_shw = mysqli_query($con,$shw);
    
                while($fa_shw = mysqli_fetch_assoc($q_shw)){
                    echo "<div class='prod'>
                            <span>".$fa_shw['nazwa']." </span><label>Nr".$fa_shw['id']."<label><br/>
                            <form class='update' method='post' action='#'>
                                <div><input type='float' name='old' value='".$fa_shw['cena']."'><span> PLN</span></div>
                                <input type='hidden' name='id' value='".$fa_shw['id']."'>
                                <button type='submit' name='zc' class='but'>zmień cenę</button>
                                <p>Ilość pozostałych: ".$fa_shw['ilosc']."</p>
                            </form>
                        </div>";
                    }
                echo '</main>
                      <article>
                        <h3>Uzupełnij całość</h3>
                        <form method="post" action="#">
                            <button id="long" name="uz" class="font-effect-neon">Uzupełnij</button>
                        </form>
                      </article>';}
    ?>
    <aside>
        <form method='post' action='#'>
            <label>Login uzupełniającego</label><br><input type='text' name='lu' class='uzup' required><br/>
            <label>Hasło uzupełniającego</label><br><input type='text' name='hu' class='uzup' required><br/>
            <button type='submit' name='g-l' class='font-effect-neon'>OK</button>
        </form>
    </aside>
</body>
</html>
<?php
if(array_key_exists('zc', $_POST)){
    $nw = $_POST['old'];
    $pid = $_POST['id'];
    $up = "UPDATE automat SET cena = $nw WHERE id = $pid;";
    mysqli_query($con, $up);
    echo "<script>location.replace('login.php')</script>";
    exit();
}
if(array_key_exists('uz', $_POST)){
    $up = "UPDATE automat SET ilosc = 10;";
    mysqli_query($con, $up);
    echo "<script>location.replace('login.php')</script>";
    exit();
}

mysqli_close($con);
?>