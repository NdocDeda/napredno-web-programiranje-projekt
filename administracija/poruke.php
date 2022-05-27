<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!");  

$query = "SELECT * FROM kontakt ORDER BY time DESC";
$result = @mysqli_query($MySQL, $query);

while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) : ?>

<span> <strong>Datum:</strong> <?= $row['time'] ?> <br/></span>
<span> <strong>Ime:</strong> <?= $row['firstname'] ?> <br/></span>
<span> <strong>Prezime:</strong> <?= $row['lastname'] ?> <br/></span>
<span> <strong>E-mail:</strong> <?= $row['email'] ?> <br/></span>
<span> <strong>Tekst poruke:</strong><?= $row['subject'] ?><br/> 

<hr>

<?php endwhile;?>

