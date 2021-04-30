<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');

    if (isset($_POST['submit']) && $_POST['submit'] != "") {
        $name = $con->real_escape_string($_POST['name']);
        $desc = $con->real_escape_string($_POST['desc']);
        $cid = $con->real_escape_string($_POST['cid']);
        $price = $con->real_escape_string($_POST['price']);
        $color = $con->real_escape_string($_POST['color']);
        $weight = $con->real_escape_string($_POST['weight']);
        $active = $con->real_escape_string($_POST['active']);
        $liqry = $con->prepare("INSERT INTO product (name, description, category_id, price, color, weight, active) VALUES (?,?,?,?,?,?,?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else {
            $liqry->bind_param('ssidsii', $name, $desc, $cid, $price, $color, $weight, $active);
            if($liqry->execute()) {
                header("location: index.php");
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
                            <h4 class="modal-title">Add User</h4>
                            <a class="close" href="./index.php" aria-hidden="true">&times;</a>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Product name</label>
                                <input type="text" class="form-control" name="name" value="" required>
                            </div>
                            <div class="form-group">
                                <label>Product description</label>
                                <input type="text" class="form-control" name="desc" value="" required>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <?php 
                                $categoryqry = $con->prepare("SELECT category_id, name FROM category;");
                                $categoryqry->bind_result($categoryId, $cName);
                        
                                if ($categoryqry->execute()) {
                                    $categoryqry->store_result();
            
                                    echo '<select name="cid" class="form-control" value="' . $categoryId . '">';
                                    while ($categoryqry->fetch()) {
                                        
                                        ?>
                                        <option value="<?php echo $categoryId; ?>"><?php echo $cName; ?></option>
                                    <?php
                                    }
                                    echo '</select>';
                                } ?>
                            </div>
                            <div class="form-group">
                                <label>Product price</label>
                                <input type="number" class="form-control" name="price" value="" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label>Product color</label>
                                <input type="text" class="form-control" name="color" value="" required>
                            </div>
                            <div class="form-group">
                                <label>Product weight</label>
                                <input type="number" class="form-control" name="weight" value="" required>
                            </div>
                            <div class="form-group">
                                <label>Product active</label>
                                <?php 
                                $activeqry = $con->prepare("SELECT active_id, active_type FROM active;");
                                $activeqry->bind_result($activeId, $activeType);
                                            
                                if ($activeqry->execute()) {
                                    $activeqry->store_result();
                                
                                    echo '<select name="active" class="form-control" value="' . $activeId . '">';
                                    while ($activeqry->fetch()) {   
                                    ?>
                                    <option value="<?php echo $activeId; ?>"><?php echo $activeType; ?></option>
                                    <?php
                                }
                                echo '</select>';
                            } ?>
                            </div>					
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" href="./index.php" ">Cancel</a>
                            <input type="submit" name="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>
<?php
    include('../core/footer.php');
?>