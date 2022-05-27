<?php 

    //Prekini ako je izravan pristup 
    if(!defined('__UP__')) {
		die("Pogreška: neovlašteni pristup!");
	} ?>


    <?php if ($user) : ?>

        <p>Prijavljeni ste kao <?php echo $user['ime'].' '.$user['prezime'].' <strong>('.$user['username'].')</strong>'; ?>.     </p>
        <p>Da bi se registrilali kao novi korisnik prvo se morate odjaviti!</p>
        <form action="" name="loginForma" id="myForm" method="POST">
        <input id="odjava" name="odjava" type="hidden" value="true">
        <input type="submit" class="odjavi_se" value="Odjava">
        </form>
 
    <?php else : ?>

        <?php if ($registracija_potvrda) : ?> 

        <p class="pogreska"> <?= $registracija_potvrda ?> </p>

        <?php else : ?>

            <form action="" name="loginForma" id="myForm" method="POST">
                    
            
                    <label for="username">Ime: </label>
                    <input type="text" id="ime" name="ime" value="" required>

                    <label for="username">Prezime: </label>
                    <input type="text" id="Prezime" name="prezime" value="" required>

                    <label for="username">Korisničko ime: </label>
                    <input type="text" id="username" name="username" value="" pattern=".{5,10}" required>
                                            
                    <label for="password">Lozinka:</label>
                    <input type="password" id="lozinka" name="lozinka" value="" pattern=".{4,}" required>

                    <label for="password">Ponovite lozinku:</label>
                    <input type="password" id="lozinka_ponovljena" name="lozinka_ponovljena" value="" pattern=".{4,}" required>
                                            
                    <input type="submit" class="prijavi_se" value="Prijava">
                    
                    <?php if ($registracija_pogreska) : ?>
                    
                    <?php endif; ?>

                    <p class="pogreska"> <?= $registracija_pogreska ?> </p>
            </form>

        <?php endif;?>

    <?php endif; ?>

    
