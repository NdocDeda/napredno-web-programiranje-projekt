<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
		        die("Pogreška: neovlašteni pristup!"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="../images/logo.png" />
    <title>CMS | PHP Web projekt</title>
</head>
<body>
    <div id="container">
    <div id="login_info"><?php require 'sesija.php' ?></div>
    <?php require 'menu.php' ?>
    <div id="content" class="<?=$odabrana_stranica?>">
        <?php if ($odabrana_stranica) : ?>
            <h2><?= $menu_items[$odabrana_stranica]['name'] ?></h2>

            <?php 
            
                if ( $menu_items[$odabrana_stranica]['zabrana'] == true) {
                    if (isset($user_id) && $user ['admin']) {
                        require $menu_items[$odabrana_stranica]['file'];
                    } else {
                        echo '<span style="font-weight: bold; color: red;">Nemate dozvolu za pristup ovoj stranici!</span>';
                    }
                } else {
                    require $menu_items[$odabrana_stranica]['file'] ;
                }

            
            
            ?>

        <?php else : ?>
            <h2>Neispravan link</h2>
            <p> Molim odabrati jednu od stavki iz izbornika </p>
        <?php endif; ?>
        

    </div>
    
    </div>
    
</body>
</html>