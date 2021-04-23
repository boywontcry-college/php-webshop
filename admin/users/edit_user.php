<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>
sssssssssss

<?php
//prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        //default user: test@test.nl
        //default password: test123
        $uid = $con->real_escape_string($_POST['uid']);
        $email = $con->real_escape_string($_POST['email']);
        $query1 = $con->prepare("UPDATE admin_user SET email = ? WHERE admin_user_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('si',$email,$uid);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Gebruiker aangepast</div>';
        }
        $query1->close();
                    
    }
?>

<h1>Gebruiker bewerken</h1>


<form action="" method="POST">
<?php
    if (isset($_GET['uid']) && $_GET['uid'] != '') {
        $uid = $con->real_escape_string($_GET['uid']);

        $liqry = $con->prepare("SELECT admin_user_id,email FROM admin_user WHERE admin_user_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$uid);
            $liqry->bind_result($adminId,$email);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo '$adminId: <input type="text" name="uid" value="' . $adminId . '" readonly><br>';
                    echo '$email: <input type="text" name="email" value="' . $email . '"><br>';
                }
            }
        }
        $liqry->close();

    }
?>
<input type="submit" name="submit" value="Opslaan">
</form>

<?php
    include('../core/footer.php');
?>