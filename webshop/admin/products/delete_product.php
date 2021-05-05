<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/checklogin_admin.php');

    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $pid = $con->real_escape_string($_POST['pid']);
        $query1 = $con->prepare("DELETE FROM product WHERE product_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('i', $pid);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            header("location: index");
        }
        $query1->close();               
    } ?>
    <div id="deleteUserModal" class="modal block">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                <?php
                    if (isset($_GET['pid']) && $_GET['pid'] != '') {
                        $pid = $con->real_escape_string($_GET['pid']);
                        $liqry = $con->prepare("SELECT product_id FROM product WHERE product_id = ? LIMIT 1;");
                        if($liqry === false) {
                            echo mysqli_error($con);
                        } 
                        $liqry->close();
                    } ?>
                    <div class="modal-header">						
                        <h4 class="modal-title">Delete User</h4>
                        <a class="close" href="./index" aria-hidden="true">&times;</a>
                    </div>
                    <div class="modal-body">
                    <?php
                    echo '<div class="form-group">
                              <input type="text" name="pid" class="form-control" value="' . $pid . '" readonly hidden>
                          </div>';
                    ?>				
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" href="./index" ">Cancel</a>
                        <input type="submit" name="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/footer.php');
?>