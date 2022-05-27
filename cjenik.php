<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); 

echo '<div id="cjenik">';                            

// Dohvat XML dokumenta
$xmlUrl = "https://api.hnb.hr/tecajn/v1?format=xml";
$xmlFile = file_get_contents($xmlUrl);
$xml = new SimpleXMLElement($xmlFile);


// Parsiranje dokumenta
foreach ($xml as $item) {
    
    $valuta = strval($item->valuta); 
    $drzava = strval($item->drzava); 
    $tecaj = floatVal(str_replace(",", ".", strval($item->srednji_tecaj)));
    $datum = strval($item->datum);
    $jedinica = intval($item->jedinica) ;
        
    $tecajnaLista [$valuta] = array(
        'valuta' => $valuta,
        'drzava' => $drzava, 
        'tecaj' => $tecaj, 
        'datum' => $datum,
        'jedinica' => $jedinica
    );

}


//Defaultna vrijednost
$valuta = "HRK";
$drzava = "Repulika Hrvatska";
$tecaj = 1;
$jedinica = 1;

if ( isset($_POST['valuta']) && $_POST['valuta'] != "HRK" )   {
    $valuta = $tecajnaLista[$_POST['valuta']]['valuta'];
    $drzava =  $tecajnaLista[$_POST['valuta']]['drzava'];
    $tecaj =  $tecajnaLista[$_POST['valuta']]['tecaj'];
    $jedinica = $tecajnaLista[$_POST['valuta']]['jedinica'];

} 

?>


<h2> Cjenik </h2>

<div class="odabir-valute">

<h3> Odabir valute za prikaz cjenika: </h3>


<form action="<?= $base_url ?>cjenik" method="post">
    <select id="valuta" name="valuta">
        <option value="HRK">Hrvatska - HRK </option>
        <?php
            foreach ($tecajnaLista as $item) {
                $selected = "";
                if (isset($_POST['valuta']) && $_POST['valuta'] == $item['valuta']) $selected = " selected";

            echo '<option value="'.$item['valuta'].'"'.$selected.'>'.$item['drzava'].' - '.$item['valuta'].  '</option>';

        } ?>
    </select>
    <input type="submit" class="posalji" value="OK">
</form>

</div>

<?php 

$artikli[] = array ('Espresso',12);
$artikli[] = array ('Espresso lungo',12);
$artikli[] = array ('Latte macchiato',15);
$artikli[] = array ('Cappuccino decaf',16);
$artikli[] = array ('Čaj',16);
$artikli[] = array ('Irish coffee',40);
$artikli[] = array ('Ledeni čaj',16);
$artikli[] = array ('Orangina',19);
$artikli[] = array ('CocaCola',20);
$artikli[] = array ('Cedevita',16);


?>
<table>
<? foreach ($artikli as $artikl): ?>
    <tr><td><?= $artikl[0]?></td><td><?= round($artikl[1]/$tecaj*$jedinica,2) ?></td> <td><?=$valuta?></td> </tr>
<? endforeach ?>
</table>

<p>Po tečajnoj listi HNB-a na dan <?= $datum ?> <br/>
<?=$jedinica?> <?=$valuta?> = <?=$tecaj?> HRK
</p>








</div>