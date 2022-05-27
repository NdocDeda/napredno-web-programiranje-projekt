<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); 

	# Spoji se na bazu
	$MySQL = mysqli_connect("localhost","root","","php_projekt") or die('Pogreška pri spajanju s nazom');