<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); 
                
// Struktura menija za stranicu
$menu_items['naslovnica'] = array( 'name' => 'Naslovnica', 'file' => 'naslovnica.php');
$menu_items['o-projektu'] = array( 'name' => 'O Projektu', 'file' => 'o-projektu.php');
$menu_items['vijesti'] = array( 'name' => 'Vijesti', 'file' => 'vijesti.php');
$menu_items['galerija'] = array( 'name' => 'Galerija', 'file' => 'galerija.php');
$menu_items['cjenik'] = array( 'name' => 'Cjenik', 'file' => 'cjenik.php');
$menu_items['kontakt'] = array( 'name' => 'Kontakt', 'file' => 'kontakt.php');
$base_url = '/phpprojekt/index.php?stranica='; 
$odabrana_stranica = '';
                
?>

<nav id="main-menu">
<ul>
    <?php foreach (array_keys($menu_items) as $menu_item ) : ?><!--
        --><?php 
            $class="";
            //Provjera jesmo li trenutno na ovoj stranici
            if (isset($_GET['stranica']) && $_GET['stranica'] == $menu_item) {
                $odabrana_stranica = $menu_item;
                $class = " class='selected' " ; }
        ?><!--
        --><li<?= $class ?>><a href="<?= $base_url . $menu_item  ?>"> <?= $menu_items[$menu_item]['name'] ?> </a> </li><!--
    --><?php endforeach; ?>
    </ul>
       
</nav>