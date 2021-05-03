<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/header.php');

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
                    echo "<meta http-equiv=\"refresh\" content=\"1; URL=users/index\">";
                    exit();
                } else {
                    echo "ERROR During login";
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
        <form action="index" method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><ion-icon name="md-finger-print"></ion-icon></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="E-mail"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit" value="login">Log In</button></div>
            <a class="forgot" href="forgot_password">Forgot your password?</a>
        </form>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/footer.php');
?>