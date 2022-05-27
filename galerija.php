<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); 

$query  = "SELECT * FROM stranice WHERE id=4";
$result = @mysqli_query($MySQL, $query);
echo '<div id="galerija">';                            
if ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
    echo '<h2>'.$row['title'].'</h2>';
    echo '<div class="sadrzaj">'. $row['content'].'</div>';
} else {
    echo '<h2> Doslo je do pogreske </h2>';
}
echo '</div>';