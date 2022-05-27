<?php 

    //Prekini ako je izravan pristup 
    if(!defined('__UP__')) {
		die("Pogreška: neovlašteni pristup!");
	} ?>


    


    <?php if ($user) : ?>

        <p class="potvrda"> <?= $registracija_potvrda ?> </p>

        <p>Prijavljeni ste kao <?php echo $user['ime'].' '.$user['prezime'].' <strong>('.$user['username'].')</strong>'; ?> </p>

        <form action="" name="loginForma" id="myForm" method="POST">
        <input id="odjava" name="odjava" type="hidden" value="true">
        <input type="submit" class="odjavi_se" value="Odjava">
        </form>
 
    <?php else : ?>

    <form action="" name="loginForma" id="myForm" method="POST">
    		<label for="username">Korisničko ime: </label>
			<input type="text" id="username" name="username" value="<?= isset($_POST['username']) && $_POST['username'] ? $_POST['username'] : ''  ?>" pattern=".{5,10}" required>
									
			<label for="password">Lozinka:</label>
			<input type="password" id="lozinka" name="lozinka" value="" pattern=".{4,}" required>
									
            <input type="submit" class="prijavi_se" value="Prijava">
            
            <?php if ($login_pogreska) : ?>
            
            <?php endif; ?>

            <p class="pogreska"> <?= $login_pogreska ?> </p>
    </form>
    
    <?php endif; ?>

    
