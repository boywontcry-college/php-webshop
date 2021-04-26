<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');

    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $cid = $con->real_escape_string($_POST['cid']);
        $query1 = $con->prepare("DELETE FROM category WHERE category_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('i', $cid);
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
                    if (isset($_GET['cid']) && $_GET['cid'] != '') {
                        $cid = $con->real_escape_string($_GET['cid']);
                        $liqry = $con->prepare("SELECT category_id FROM category WHERE category_id = ? LIMIT 1;");
                        if($liqry === false) {
                            echo mysqli_error($con);
                        } 
                        $liqry->close();
                    } ?>
                    <div class="modal-header">						
                        <h4 class="modal-title">Delete Category</h4>
                        <a class="close" href="./index.php" aria-hidden="true">&times;</a>
                    </div>
                    <div class="modal-body">
                    <?php
                    echo '<div class="form-group">
                              <input type="text" name="cid" class="form-control" value="' . $cid . '" readonly hidden>
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