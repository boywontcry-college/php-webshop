<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<hr>

<div style="background-color: red">hallo</div>
<?php
        $liqry = $con->prepare("SELECT admin_user_id,email FROM admin_user");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_result($adminId,$email);
            if($liqry->execute()){
                $liqry->store_result();
                while($liqry->fetch()) {
                    echo 'admin id :' . $adminId . " - ";
                    echo 'email :' . $email . " - ";
                    echo '<a href="edit_user.php?uid='.$adminId.'">edit</a><br>';
                }
            }
            $liqry->close();
        }

?>

<?php
    include('../core/footer.php');
?>
