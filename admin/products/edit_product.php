<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');

    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $pid = $con->real_escape_string($_POST['pid']);
        $name = $con->real_escape_string($_POST['name']);
        $desc = $con->real_escape_string($_POST['desc']);
        $cid = $con->real_escape_string($_POST['cid']);
        $price = $con->real_escape_string($_POST['price']);
        $color = $con->real_escape_string($_POST['color']);
        $weight = $con->real_escape_string($_POST['weight']);
        $active = $con->real_escape_string($_POST['active']);
        $query1 = $con->prepare("UPDATE product AS p SET p.name = ?, p.description = ?, p.category_id = ?, p.price = ?, p.color = ?, p.weight = ?, p.active = ? WHERE p.product_id = ?;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('ssidsiii', $name, $desc, $cid, $price, $color, $weight, $active, $pid);
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
                            <h4 class="modal-title">Edit User</h4>
                            <a class="close" href="./index.php" aria-hidden="true">&times;</a>
                        </div>
                        <div class="modal-body">
                        <?php
                            if (isset($_GET['pid']) && $_GET['pid'] != '') {
                                $pid = $con->real_escape_string($_GET['pid']);
                                $liqry = $con->prepare("SELECT p.product_id, p.name, p.description, p.category_id, p.price, p.color, p.weight, p.active FROM product AS p WHERE p.product_id = ? LIMIT 1;");
                                if($liqry === false) {
                                echo mysqli_error($con);
                                } else{
                                    $liqry->bind_param('i', $pid);
                                    $liqry->bind_result($productId, $productName, $productDescription, $categoryId, $productPrice, $productColor, $productWeight, $productActive);
                                    if($liqry->execute()){
                                        $liqry->store_result();
                                        $liqry->fetch();
                                        if($liqry->num_rows == '1'){
                                            echo '<div class="form-group">
                                                      <label>Product ID</label>
                                                      <input type="text" name="pid" class="form-control" value="' . $productId . '" readonly>
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Product name</label>
                                                      <input type="text" name="name" class="form-control" value="' . $productName . '" required>
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Product description</label>
                                                      <input type="text" name="desc" class="form-control" value="' . $productDescription . '" required>
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Category ID</label>
                                                      <input type="number" name="cid" class="form-control" value="' . $categoryId . '" required>
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Product price</label>
                                                      <input type="number" name="price" class="form-control" step="0.01" value="' . $productPrice . '" required>
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Product color</label>
                                                      <input type="text" name="color" class="form-control" value="' . $productColor . '" required>
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Product weight</label>
                                                      <input type="number" name="weight" class="form-control" value="' . $productWeight . '" required>
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Product active</label>
                                                      <input type="number" name="active" class="form-control" value="' . $productActive . '" required>
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