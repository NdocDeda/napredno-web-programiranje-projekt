<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); 

//spremanje u bazu                
if (isset($_POST['submited']) && $_POST['submited'] == 'true') {
    

    $query = "UPDATE vijesti SET 
                    naslov = '".$_POST['naslov']."', 
                    slika = '".$_POST['slika']."', 
                    text= '".$_POST['text']."', 
                    updated_at = current_timestamp()
                    WHERE id=".$_GET['id'].";";

    $result = @mysqli_query($MySQL, $query);

    echo '<span style="color:red">Promjene su spremljene!</span>  <br/><br/>';
}


?>


<div id="vijesti">

<?php if (isset($_GET['id']) ) : ?>

    <?php if (isset($_GET['delete']) && $_GET['delete']==true) {
        $query = "DELETE FROM vijesti WHERE id = ".$_GET['id'];
        $result = @mysqli_query($MySQL, $query);
        echo '<span style="color:red">Vijest je obrisana.</span>';
    } else { 
        $news_id = null;
        if ($_GET['id']=='new') {
            //nova vijest
            $query = "INSERT INTO vijesti (naslov) VALUES ('Nova vijest')";
            $result = @mysqli_query($MySQL, $query);
            $news_id = $MySQL->insert_id;
        }
            if ($news_id == '') 
                $news_id = $_GET['id'];

            $query  = "SELECT * FROM vijesti WHERE id=".$news_id;
            $result = @mysqli_query($MySQL, $query);
            if ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                ?> 
                    <span> Datum kreiranja: <?= $row['created_at'] ?> <br/> </span>
                    <span> Datum zadnje promjene: <?= $row['updated_at'] ?> <br/><br/> </span>
                    <form action="<?= $base_url ?>vijesti&id=<?= $row['id']?>" method="post">

                        <label for="naslov">Naslov</label>
                        <input type="text" id="naslov_" name="naslov" value="<?= $row['naslov'] ?>" required >

                        <label for="slika">Slika</label>
                        <input type="text" id="slika_" name="slika" value="<?= $row['slika'] ?>" required >

        
                        <label for="text">Tekst vijesti:</label>
                        <textarea id="text_" name="text"  required style="height:200px"><?= $row['text'] ?></textarea>

                        <input type="hidden" name="submited" value="true">

                        <input type="submit" class="spremi" value="Spremi">

                    </form>

                <?php
            }           
            
            

    }


    ?>

    

<?php else : ?>

<a href="<?= $base_url ?>vijesti&id=new"> Dodaj novu vijest </a>

<hr>

<?php

$query = "SELECT * FROM vijesti ORDER BY created_at DESC";
$result = @mysqli_query($MySQL, $query);

while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) : ?>

<span> <strong>Naslov:</strong> <?= $row['naslov'] ?> <br/></span>
<span> <strong>Datum kreiranja:</strong> <?= $row['created_at'] ?> <br/></span>
<span> <strong>Zadnja promjena:</strong> <?= $row['updated_at'] ?> <br/></span>
<br/>
<a href="<?= $base_url ?>vijesti&id=<?= $row['id']?>"> Uredi </a> | <a href="<?= $base_url ?>vijesti&id=<?= $row['id']?>&delete=true" style="color:red"> Obriši </a>


<hr>

<?php endwhile;?>
</div>

<?php endif?>