<?php
    include('core/header.php');

    if (isset($_POST['submit']) && $_POST['submit'] != '') {

        $email = $con->real_escape_string($_POST['email']);
        $password = $con->real_escape_string($_POST['password']);
        
        $liqry = $con->prepare("SELECT admin_user_id,email,password FROM admin_user WHERE email = ? LIMIT 1;");
        if($liqry === false) {
            trigger_error(mysqli_error($con));
        } else {
            $liqry->bind_param('s',$email);
            $liqry->bind_result($adminId,$email,$dbHashPassword);
            if($liqry->execute()) {
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1' && password_verify($password,$dbHashPassword)) {
                    $_SESSION['Sadmin_id'] = $adminId;
                    $_SESSION['Sadmin_email'] = stripslashes($email);
                    echo "Bezig met inloggen... <meta http-equiv=\"refresh\" content=\"1; URL=users/\">";
                    exit();
                } else {
                    echo "ERROR tijdens inloggen";
                }
            }
            $liqry->close();
        }
    }
?>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="#">Creep's Webshop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
            </div>
        </div>
    </nav>
    <div class="login-clean">
        <form action="index.php" method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="E-mail"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit" value="login">Log In</button></div>
            <a class="forgot" href="forgot_password.php">Forgot your password?</a>
        </form>
    </div>
<?php
    include('core/footer.php');
?>