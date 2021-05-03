<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/header.php');

    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $email = $con->real_escape_string($_POST['email']);

        $liqry = $con->prepare("SELECT admin_user_id,email FROM admin_user WHERE email = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('s',$email);
            $liqry->bind_result($adminId,$email);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){

                    $token = sha1(mt_rand(1, 90000) . 'WEBSHOP2021-1wdv');

                    $url = BASEURL_CMS.'verify_password?token='.$token;
                    
                    $query1 = $con->prepare("UPDATE admin_user SET password_token = ? WHERE admin_user_id = ? LIMIT 1;");
                    if ($query1 === false) {
                        echo mysqli_error($con);
                    }
                    
                    $query1->bind_param('si',$token,$adminId);
                    if ($query1->execute() === false) {
                        echo mysqli_error($con);
                    } 
                    $query1->close();
                    
                    header("location: $url");
                    exit();
                } else {
                    echo "ERROR During request";
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
        <form action="forgot_password" method="post">
            <h2 class="sr-only">Request Password Form</h2>
            <div class="illustration"><ion-icon name="help"></ion-icon></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="E-mail"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit" value="Request password">Request password</button></div>
            <a class="forgot" href="index">Return to log in.</a>
        </form>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/footer.php');
?>