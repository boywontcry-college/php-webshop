<?php
    
    // onderstaand bestand wordt ingeladen
    include('core/header.php');

    // is de postwaarde 'submit' aanwezig en is ie niet leeg
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123


        // binnenkomende waarden wordt 'ge-escaped' / omgezet in voor database veilige waarde
        // en in een variable weggeschreven
        $email = $con->real_escape_string($_POST['email']);
        $password = $con->real_escape_string($_POST['password']);
        

        // de database-query wordt voorbereid
        // query opgebouwd: haal admin_user_id,email en password uit de tabel admin_user waar het email gelijk is aan parameter die er later aan wordt verbonden
        $liqry = $con->prepare("SELECT admin_user_id,email,password FROM admin_user WHERE email = ? LIMIT 1;");
        // als de voorbereiding niet goed is, geef dan een foutmelding met de msqli-fout
        if($liqry === false) {
            trigger_error(mysqli_error($con));
        } else{
            // binnengekomen waarde $email wordt aan de query verbonden. Het is een [s]tring, vandaar de s
            $liqry->bind_param('s',$email);
            // de verbinden van de resultaten van de query aan variabelen
// hiermee ga je de gegevens die uit de database-query komen, opslaan in variabelen 
            $liqry->bind_result($adminId,$email,$dbHashPassword);
            // de query wordt uitgevoerd
            if($liqry->execute()){
                // resultaat van de uitgevoerde query wordt opgeslagen
                $liqry->store_result();
                // de gegevens van de query worden binnengehaald
                $liqry->fetch();
                // als er 1 treffer uit de query komt en het ingevoerd $password is klopt met de hash ervan
                if($liqry->num_rows == '1' && password_verify($password,$dbHashPassword)){
                    // opslaan van id in de admin-tabel in een session met de naam Sadmin_id
                    $_SESSION['Sadmin_id'] = $adminId; // Sadmin_id
                    // en opslaan van admin-email adres in een session met de naam Sadmin_email
                    $_SESSION['Sadmin_email'] = stripslashes($email);
                    // 'bezig met inloggen komt in beeld, en de pagina ververst naar index_loggedin.php
                    echo "Bezig met inloggen... <meta http-equiv=\"refresh\" content=\"1; URL=index_loggedin.php\">";
                    exit();
                } else {
                    echo "ERROR tijdens inloggen";
                }
            }
            $liqry->close();
        }
    }
?>
<form action="index.php" method="post">
    <input type="email" name="email" id="" placeholder="Email">
    <input type="password" name="password" id="" placeholder="Password">
    <input type="submit" name="submit" value="Login">
    <a href="forgot_password.php">Forgot Password?</a>
</form>
<?php
    include('core/footer.php');
?>