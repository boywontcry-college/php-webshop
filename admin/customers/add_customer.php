<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/checklogin_admin.php');

    if (isset($_POST['submit']) && $_POST['submit'] != "") {
        $gender = $con->real_escape_string($_POST['gender']);
        $firstName = $con->real_escape_string($_POST['firstName']);
        $middleName = $con->real_escape_string($_POST['middleName']);
        $lastName = $con->real_escape_string($_POST['lastName']);
        $street = $con->real_escape_string($_POST['street']);
        $houseNumber = $con->real_escape_string($_POST['houseNumber']);
        $houseNumberAddon = $con->real_escape_string($_POST['houseNumberAddon']);
        $zipCode = $con->real_escape_string($_POST['zipCode']);
        $city = $con->real_escape_string($_POST['city']);
        $phone = $con->real_escape_string($_POST['phone']);
        $email = $con->real_escape_string($_POST['email']);
        $newsletter = $con->real_escape_string($_POST['newsletter']);
        $liqry = $con->prepare("INSERT INTO customer (gender, first_name, middle_name, last_name, street, house_number, house_number_addon, zip_code, city, phone, emailadres, newsletter_subscription) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else {
            $liqry->bind_param('sssssisssssi', $gender, $firstName, $middleName, $lastName, $street, $houseNumber, $houseNumberAddon, $zipCode, $city, $phone, $email, $newsletter);
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
                            <h4 class="modal-title">Add Customer</h4>
                            <a class="close" href="./index" aria-hidden="true">&times;</a>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Gender</label>
                                <?php 
                                $genderqry = $con->prepare("SELECT gender_type FROM gender;");
                                $genderqry->bind_result($gender);
                        
                                if ($genderqry->execute()) {
                                    $genderqry->store_result();
            
                                    echo '<select name="gender" class="form-control" value="' . $gender . '">';
                                    while ($genderqry->fetch()) {                                
                                    ?>
                                    <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                    <?php
                                    }
                                    echo '</select>';
                                } ?>
                            </div>
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" name="firstName" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label>Middle name</label>
                                <input type="text" name="middleName" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" name="lastName" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label>Street</label>
                                <input type="text" name="street" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label>House number</label>
                                <input type="number" name="houseNumber" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label>House number addon</label>
                                <input type="text" name="houseNumberAddon" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label>Zip code</label>
                                <input type="text" name="zipCode" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="text" name="phone" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label>Subscribed</label>
                                <?php 
                                $subscribeqry = $con->prepare("SELECT subscribe_id, subscribe_type FROM subscribe;");
                                $subscribeqry->bind_result($subscribeId, $subscribeType);
                                            
                                if ($subscribeqry->execute()) {
                                    $subscribeqry->store_result();
                                
                                    echo '<select name="newsletter" class="form-control" value="' . $subscribeId . '">';
                                    while ($subscribeqry->fetch()) {   
                                    ?>
                                    <option value="<?php echo $subscribeId; ?>"><?php echo $subscribeType; ?></option>
                                    <?php
                                }
                                echo '</select>';
                            } ?>
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