<?php       //Prekini ako je izravan pristup 
            if(!defined('__UP__')) 
                die("Pogreška: neovlašteni pristup!"); 


        $user = null;        
        $login_pogreska = null;
        $registracija_pogreska = null;
        $registracija_potvrda = null;

        if (isset($_GET['cms']) && $_GET['cms'] == 'registracija') {
            
            $ime = null;
            if (isset($_POST['ime']))
                $ime = $MySQL->real_escape_string($_POST['ime']);

            $prezime = null;
            if (isset($_POST['prezime']))
                $prezime = $MySQL->real_escape_string($_POST['prezime']);

            $username = null;    
            if (isset($_POST['username']))
                $username = $MySQL->real_escape_string($_POST['username']);
            
            $lozinka = null;
            if (isset($_POST['lozinka']))
                $lozinka = $MySQL->real_escape_string($_POST['lozinka']);
            
            $lozinka_ponovljena = null;
            if (isset($_POST['lozinka_ponovljena']))
                $lozinka_ponovljena = $MySQL->real_escape_string($_POST['lozinka_ponovljena']);
        

            if ($lozinka && $username) {
                if ($lozinka == $lozinka_ponovljena) {

                    if (strlen($lozinka)<4) {
                        $registracija_pogreska = "Lozinka je prekratka! Minimalno 4 znaka";
                    } else {

                        if (strlen($username)<5) {
                            $registracija_pogreska = "Korisničko ime je prekratko! Minimalno 5 znakova";
                        } else {
                            
                            $query  = "SELECT * FROM korisnici";
                            $query .= " WHERE username='" .  $username . "';" ;
                            
                            $result = @mysqli_query($MySQL, $query);
                            
                            if ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                                $registracija_pogreska = "Korisnik s ovim korisničkim imenom već postoji.";

                            } else {

                                $query = "  INSERT INTO korisnici 
                                    (username, ime, prezime, lozinka) 
                                VALUES
                                    ('$username', '$ime', '$prezime', '".password_hash($lozinka, PASSWORD_DEFAULT )."');";
                                @mysqli_query($MySQL, $query);    
                                
                                $registracija_potvrda = "Uspješno ste se registrirali.";

                                $_GET['cms'] = 'prijava';
                                $_POST['username'] = $username;
                                $_POST['lozinka'] = $lozinka; 

                            }
                        }
                    }
                        
                } else {
                    $registracija_pogreska = "Ponovljane lozinka nije jednaka lozinki!!!";
                }
            }
                

        }

        if (isset($_POST['odjava']) && $_POST['odjava'] == 'true') {
            
            //obrisi cookie
            $token_sesije = $MySQL->real_escape_string ( $_COOKIE['token_sessije']);
            setcookie("token_sessije", "", time()-3600);

            //postavi vrijednost tokena u bazi na false
            $query = "UPDATE sesije SET active=false WHERE token='$token_sesije'";
            @mysqli_query($MySQL, $query);

        }

        if (isset($_COOKIE['token_sessije']) && $_COOKIE['token_sessije']) {
            

            $token_sesije = $MySQL->real_escape_string ( $_COOKIE['token_sessije']);

            //Tražimo token kojeg smo spremili u cookie sesije 
            $query  = "SELECT * FROM sesije";
            $query .= " WHERE token='" .  $token_sesije . "'" ;
            $query .= " and active=1".";" ;

            $result = @mysqli_query($MySQL, $query);
            if ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                //obnovi cookie
                setcookie ("token_sessije",$token_sesije,time()+1800); 

                //update timnstampa u nazi
                $user_id = $row['user_id'];
                
                $query = "UPDATE sesije SET updated_at=now() WHERE token='$token_sesije'";
                @mysqli_query($MySQL, $query);

                $query  = "SELECT * FROM korisnici";
                $query .= " WHERE id='" .  $user_id ."';" ;
                $result = @mysqli_query($MySQL, $query);

                if ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                    $user ['id'] = $row['id'];
                    $user ['username'] = $row['username'];
                    $user ['ime'] = $row['ime'];
                    $user ['prezime'] = $row['prezime'];
                    $user ['admin'] = $row['admin'];
                    

                }

                
        
            }


        }

        if (!$user && isset($_GET['cms']) && $_GET['cms'] == 'prijava' && isset($_POST['username']) && isset($_POST['lozinka'])) {
            
                            
                $korisnicko_ime = $MySQL->real_escape_string ( $_POST['username']);
          
                $query  = "SELECT * FROM korisnici";
                $query .= " WHERE username='" .  $korisnicko_ime ."';" ;

                $result = @mysqli_query($MySQL, $query);
                $row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                if ( password_verify($_POST['lozinka'],$row['lozinka'])) {

                $token = bin2hex(random_bytes(20));
                $query = "  INSERT INTO sesije 
                                (user_id, token, created_at, updated_at, active) 
                            VALUES
                                ($row[id], '$token', NOW(), NOW(),True );";

                //Neaktivnost od 30 minuta
                setcookie ("token_sessije",$token,time()+1800); 

                @mysqli_query($MySQL, $query);

                $user ['id'] = $row['id'];
                $user ['username'] = $row['username'];
                $user ['ime'] = $row['ime'];
                $user ['prezime'] = $row['prezime'];

                
                } else {
                    $login_pogreska = "Neispravno korisničko ime ili lozinka";
                }

        }

        if ($user) {
            echo "Pozdrav, $user[ime] $user[prezime] | <a href=\"http://localhost/phpprojekt/administracija/index.php?cms=prijava\"> Odjava </a>";
        } else {
            echo 'Niste prijavljeni | <a href="http://localhost/phpprojekt/administracija/index.php?cms=prijava"> Prijava </a>';
        }

        

        

        
        
?>