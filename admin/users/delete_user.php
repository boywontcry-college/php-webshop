<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');

    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $uid = $con->real_escape_string($_POST['uid']);
        $query1 = $con->prepare("DELETE FROM admin_user WHERE admin_user_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('i', $uid);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            header("location: index.php");
        }
        $query1->close();               
    } ?>
    <div id="deleteUserModal" class="modal block">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                <?php
                    if (isset($_GET['uid']) && $_GET['uid'] != '') {
                        $uid = $con->real_escape_string($_GET['uid']);
                        $liqry = $con->prepare("SELECT admin_user_id FROM admin_user WHERE admin_user_id = ? LIMIT 1;");
                        if($liqry === false) {
                            echo mysqli_error($con);
                        } 
                        $liqry->close();
                    } ?>
                    <div class="modal-header">						
                        <h4 class="modal-title">Delete Administrator</h4>
                        <a class="close" href="./index.php" aria-hidden="true">&times;</a>
                    </div>
                    <div class="modal-body">
                    <?php
                    echo '<div class="form-group">
                              <input type="text" name="uid" class="form-control" value="' . $uid . '" readonly hidden>
                          </div>';
                    ?>				
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" href="./index.php" ">Cancel</a>
                        <input type="submit" name="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    include('../core/footer.php');
?>