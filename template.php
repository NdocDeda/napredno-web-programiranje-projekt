<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); ?>
                
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="images/logo.png" />
    <title>PHP Web projekt</title>
</head>
<body>
    <header>

    <div id="login"><a href="administracija/index.php?cms=prijava"> CMS </a></div>
    
    <h1 style="display: inline-block; padding: 10px 0px 20px 120px">PHP Web projekt </h1>

    <?php require "menu.php"; ?>
    
    </header>
    <div id="content" >
    <?php if ($odabrana_stranica) {
        require ($menu_items[$odabrana_stranica]['file']);

    } else {
        echo "<h2>Neispravan link. </h2><p> Molimo odabrati stranicu iz glavnog izbornika</p>";
    }
    ?>
    </div>

    <footer>
    Napredno web programiranje | Ndoc Deda | 2021 - 2022
    </footer>
</body>
</html>