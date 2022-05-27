<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); 


$base_url = '/phpprojekt/administracija/index.php?cms=';                

$odabrana_stranica = null;

// Struktura menija za CMS
$menu_items['vijesti'] = array( 'name' => 'Vijesti', 'file' => 'vijesti.php', 'zabrana'=>true);
$menu_items['naslovnica'] = array( 'name' => 'Naslovnica', 'file' => 'naslovnica.php', 'zabrana'=>true);
$menu_items['o-projektu'] = array( 'name' => 'O projektu', 'file' => 'o-projektu.php', 'zabrana'=>true);
$menu_items['galerija'] = array( 'name' => 'Galerija', 'file' => 'galerija.php', 'zabrana'=>true);
//$menu_items['upload'] = array( 'name' => 'Prenošenje datoteka', 'file' => 'stranice.php', 'zabrana'=>true);
$menu_items['poruke'] = array( 'name' => 'Poruke posjetitelja', 'file' => 'poruke.php','zabrana'=>true);
//$menu_items['korisnici'] = array( 'name' => 'Prava korisnika', 'file' => 'vijesti.php','zabrana'=>true);
$menu_items['prijava'] = array( 'name' => 'Prijava / Odjava', 'file' => 'login.php','zabrana'=>false);
$menu_items['registracija'] = array( 'name' => 'Registracija', 'file' => 'registracija.php','zabrana'=>false);
                
?>

<nav id='menu'>
    <span> CMS Izbornik </span>
    <ul>
    <?php foreach (array_keys($menu_items) as $menu_item ) : ?>
        <?php 
            $class="";
            //Provjera jesmo li trenutno na ovoj stranici
            if (isset($_GET['cms']) && $_GET['cms'] == $menu_item) {
                $odabrana_stranica = $menu_item;
                $class = " class='selected' " ; }
        ?>
        <li<?= $class ?>><a href="<?= $base_url . $menu_item  ?>"> <?= $menu_items[$menu_item]['name'] ?> </a> </li>
    <?php endforeach; ?>
    </ul>

</nav>