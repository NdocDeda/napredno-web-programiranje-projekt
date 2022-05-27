<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); ?>

<div id="vijesti">


<?php

if (isset($_GET['id']) &&  $_GET['id'] ) {

    $query = "SELECT * FROM vijesti WHERE id=". $_GET['id'];
    $result = @mysqli_query($MySQL, $query);
    
    while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) : ?>
    <h2> <?= $row['naslov'] ?></h2>
    <span class="datumi"> Datum kreiranja: <?= $row['created_at'] ?> </span>
    <span class="datumi"> Zadnja promjena: <?= $row['updated_at'] ?> </span>
    <img class="slika" src="<?= $row['slika']?>" >
    <div class="text">  <?= $row['text'] ?></div>

    </div>
    
    <?php endwhile;

} else {
    
    $query = "SELECT * FROM vijesti ORDER BY created_at DESC";
    $result = @mysqli_query($MySQL, $query);
    
    echo '<h2> Vijesti </h2>';

    while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) : ?>
        
    <div class="box" style="background-image: url('<?= $row['slika']?>')">
    <span class="naslov">  <?= $row['naslov'] ?> </span>
    <span class="datumi"> Datum kreiranja: <?= $row['created_at'] ?> </span>
    <span class="datumi"> Zadnja promjena: <?= $row['updated_at'] ?> </span>
    <div class="text">  <?= substr($row['text'], 0, 200) ?>... </div>
    <span class="more"> <a  href="<?= $base_url ?>vijesti&id=<?= $row['id']?>">>> Pročitaj više </a> </span>
    </div>
    
    <?php endwhile;?>
    

<?php } ?>




</div>
