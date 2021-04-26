<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');

    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $uid = $con->real_escape_string($_POST['uid']);
        $email = $con->real_escape_string($_POST['email']);
        $query1 = $con->prepare("UPDATE admin_user SET email = ? WHERE admin_user_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('si', $email, $uid);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            header("location: index.php");
        }
        $query1->close();               
    } ?>
    <div class="container-xl">
        <div id="editUserModal" class="modal block">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">						
                            <h4 class="modal-title">Edit Administrator</h4>
                            <a class="close" href="./index.php" aria-hidden="true">&times;</a>
                        </div>
                        <div class="modal-body">
                        <?php
                            if (isset($_GET['uid']) && $_GET['uid'] != '') {
                                $uid = $con->real_escape_string($_GET['uid']);
                                $liqry = $con->prepare("SELECT a.admin_user_id, a.email FROM admin_user AS a WHERE a.admin_user_id = ? LIMIT 1;");
                                if($liqry === false) {
                                echo mysqli_error($con);
                                } else{
                                    $liqry->bind_param('i', $uid);
                                    $liqry->bind_result($adminId, $adminEmail);
                                    if($liqry->execute()){
                                        $liqry->store_result();
                                        $liqry->fetch();
                                        if($liqry->num_rows == '1'){
                                        echo '<div class="form-group">
                                                  <label>Admin UID</label>
                                                  <input type="text" name="uid" class="form-control" value="' . $adminId . '" readonly>
                                              </div>
                                              <div class="form-group">
                                                  <label>E-mail</label>
                                                  <input type="email" name="email" class="form-control" value="' . $adminEmail . '" required>
                                              </div>';
                                        }
                                    }
                                }
                                $liqry->close();
                            } ?>								
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" href="./index.php" ">Cancel</a>
                            <input type="submit" name="submit" class="btn btn-info" value="Edit">
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>
<?php
    include('../core/footer.php');
?>