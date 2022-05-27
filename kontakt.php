<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); ?>
                
<h2> Kontakt forma </h2>

<?php // Spremi u bazu 

if (isset($_POST['submited']) && $_POST['submited'] == 'true') {
    
    $query = "INSERT INTO kontakt (firstname, lastname,email,subject) VALUES ('"
                    .$_POST['firstname']."', '" 
                    .$_POST['lastname']."', '" 
                    .$_POST['email']."', '" 
                    .$_POST['subject']."');" ;

    $result = @mysqli_query($MySQL, $query);

    echo '<span style="display: block; color: red;">Poruka je poslana</span><br/>';
}


?>

<div id="kontakt">
  <form action="<?= $base_url ?>kontakt" method="post">

    <label for="fname">Ime</label>
    <input type="text" id="fname" name="firstname" required placeholder="Vase ime...">

    <label for="lname">Prezime</label>
    <input type="text" id="lname" name="lastname" required placeholder="Vase prezime...">

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required placeholder="Vase e-mail adresa...">

    <label for="subject">Sadržaj:</label>
    <textarea id="subject" name="subject"  required placeholder="Write something.." style="height:200px"></textarea>

    <input type="hidden" name="submited" value="true">

    <input type="submit" class="posalji" value="Pošalji">

  </form>
</div>