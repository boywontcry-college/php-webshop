<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/header.php');

    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $token = $con->real_escape_string($_GET['token']);
        $password_1 = $con->real_escape_string($_POST['password_1']);
        $password_2 = $con->real_escape_string($_POST['password_2']);
        
        $liqry = $con->prepare("SELECT admin_user_id,email FROM admin_user WHERE password_token = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('s',$token);
            $liqry->bind_result($adminId,$email);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1' && $password_1 == $password_2){

                    $password = password_hash($password_1, PASSWORD_DEFAULT);
                    
                    $query1 = $con->prepare("UPDATE admin_user SET password = ?, password_token = '', password_changed = NOW() WHERE admin_user_id = ? LIMIT 1;");
                    if ($query1 === false) {
                        echo mysqli_error($con);
                    }
                    
                    $query1->bind_param('si',$password,$adminId);
                    if ($query1->execute() === false) {
                        echo mysqli_error($con);
                    } 
                    $query1->close();
                    
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=index\">";
                    exit();
                } else {
                    echo "ERROR Passwords are not the same.";
                }
            }
            $liqry->close();
        }
    }
?>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="/">Creep's Webshop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
            </div>
        </div>
    </nav>
    <div class="login-clean">
        <form action="verify_password?token=<?= $_GET['token'];?>" method="post">
            <h2 class="sr-only">Verify Password Form</h2>
            <div class="illustration"><ion-icon name="lock"></ion-icon></div>
            <div class="form-group"><input class="form-control" type="password" name="password_1" placeholder="Password"></div>
            <div class="form-group"><input class="form-control" type="password" name="password_2" placeholder="Repeat password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit" value="Request password">Change password</button></div>
            <a class="forgot" href="index">Return to log in.</a>
        </form>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/footer.php');
?>