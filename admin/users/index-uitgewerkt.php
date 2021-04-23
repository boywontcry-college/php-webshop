<?php
// onderstaand bestand wordt ingeladen
include('../core/header.php');
include('../core/checklogin_admin.php');

?>

<?php
        $usiqry = $con->prepare("SELECT admin_user_id,email,password_changed,datetime FROM admin_user");
        // als de voorbereiding niet goed is, geef dan een foutmelding met de msqli-fout
        if($usiqry === false) {
            trigger_error(mysqli_error($con));
        } else{
            $usiqry->bind_result($adminId,$email,$password_changed,$datetime);
            // de query wordt uitgevoerd
            if($usiqry->execute()){
                // resultaat van de uitgevoerde query wordt opgeslagen
                $usiqry->store_result();
                // de gegevens van de query worden binnengehaald
                // while ($usiqry->fetch() ) {
                //     echo $adminId . " - ";
                //     echo $email . "<br>";
                // }
                
  
                // table>tr*1>td*4
                echo '<table border=1>
                        <tr>
                            <td>admin uid</td>
                            <td>email</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
                while ($usiqry->fetch() ) { ?>
                        <tr>
                        <td><?php echo $adminId; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><a href="edit_user.php?uid=<?php echo $adminId; ?>">edit</a></td>
                        <td><a href="delete_user.php?uid=<?php echo $adminId; ?>">delete</a></td>
                    </tr>
                    <?php 
                }
                echo '</table>';

  
  
  
  
            }
            $usiqry->close();
        }


?>



<?php
    include('../core/footer.php');
?>