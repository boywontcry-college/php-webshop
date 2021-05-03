<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/checklogin_admin.php');

    if (isset($_POST['email']) && $_POST['email'] != "") {
        $email = $con->real_escape_string($_POST['email']);
        $liqry = $con->prepare("INSERT INTO admin_user (email) VALUES (?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else {
            $liqry->bind_param('s',$email);
            if($liqry->execute()) {
                header("location: index");
            }
        }
        $liqry->close();
    }
?>
    <div class="container-xl">
        <div id="addUserModal" class="modal block">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">						
                            <h4 class="modal-title">Add Administrator</h4>
                            <a class="close" href="./index" aria-hidden="true">&times;</a>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" name="email" value="" required>
                            </div>					
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" href="./index" ">Cancel</a>
                            <input type="submit" name="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/footer.php');
?>