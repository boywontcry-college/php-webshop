<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');

    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $cid = $con->real_escape_string($_POST['cid']);
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
        $query1 = $con->prepare("UPDATE customer AS c SET c.gender = ?, c.first_name = ?, c.middle_name = ?, c.last_name = ?, c.street = ?, c.house_number = ?, c.house_number_addon = ?, c.zip_code = ?, c.city = ?, c.phone = ?, c.emailadres = ?, c.newsletter_subscription = ? WHERE c.customer_id = ?;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('sssssisssssii', $gender, $firstName, $middleName, $lastName, $street, $houseNumber, $houseNumberAddon, $zipCode, $city, $phone, $email, $newsletter, $cid);
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
                            <h4 class="modal-title">Edit Customer</h4>
                            <a class="close" href="./index.php" aria-hidden="true">&times;</a>
                        </div>
                        <div class="modal-body">
                        <?php
                            if (isset($_GET['cid']) && $_GET['cid'] != '') {
                                $cid = $con->real_escape_string($_GET['cid']);
                                $liqry = $con->prepare("SELECT c.customer_id, c.gender, c.first_name, c.middle_name, c.last_name, c.street, c.house_number, c.house_number_addon, c.zip_code, c.city, c.phone, c.emailadres, c.newsletter_subscription FROM customer AS c WHERE c.customer_id = ? LIMIT 1;");
                                if($liqry === false) {
                                echo mysqli_error($con);
                                } else{
                                    $liqry->bind_param('i', $cid);
                                    $liqry->bind_result($customerId, $customerGender, $customerFirstName, $customerMiddleName, $customerLastName, $customerStreet, $customerHouseNumber, $customerHouseNumberAddon, $customerZipCode, $customerCity, $customerPhone, $customerEmail, $customerNewsletter);
                                    if($liqry->execute()){
                                        $liqry->store_result();
                                        $liqry->fetch();
                                        if($liqry->num_rows == '1'){
                                            ?>
                                                <div class="form-group">
                                                    <label>Customer ID</label>
                                                    <input type="number" name="cid" class="form-control" value="<?php echo $customerId ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <?php 
                                                    $genderqry = $con->prepare("SELECT gender_type FROM gender;");
                                                    $genderqry->bind_result($genderType);
                                            
                                                    if ($genderqry->execute()) {
                                                        $genderqry->store_result();
                                
                                                        echo '<select name="gender" class="form-control" value="' . $customerGender . '">';
                                                        while ($genderqry->fetch()) { 
                                                            $selected = "";
                                                            if ($customerGender == $genderType) {
                                                                $selected = "selected";
                                                            }                                
                                                        ?>
                                                        <option value="<?php echo $genderType; ?>"<?php echo $selected; ?>><?php echo $genderType; ?></option>
                                                        <?php
                                                        }
                                                        echo '</select>';
                                                    } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>First name</label>
                                                    <input type="text" name="firstName" class="form-control" value="<?php echo $customerFirstName ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Middle name</label>
                                                    <input type="text" name="middleName" class="form-control" value="<?php echo $customerMiddleName ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Last name</label>
                                                    <input type="text" name="lastName" class="form-control" value="<?php echo $customerLastName ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Street</label>
                                                    <input type="text" name="street" class="form-control" value="<?php echo $customerStreet ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>House number</label>
                                                    <input type="number" name="houseNumber" class="form-control" value="<?php echo $customerHouseNumber ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>House number addon</label>
                                                    <input type="text" name="houseNumberAddon" class="form-control" value="<?php echo $customerHouseNumberAddon ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Zip code</label>
                                                    <input type="text" name="zipCode" class="form-control" value="<?php echo $customerZipCode ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" name="city" class="form-control" value="<?php echo $customerCity ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone number</label>
                                                    <input type="number" name="phone" class="form-control" value="<?php echo $customerPhone ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>E-mail</label>
                                                    <input type="email" name="email" class="form-control" value="<?php echo $customerEmail ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Subscribed</label>
                                                    <?php 
                                                    $subscribeqry = $con->prepare("SELECT subscribe_id, subscribe_type FROM subscribe;");
                                                    $subscribeqry->bind_result($subscribeId, $subscribeType);
                                            
                                                    if ($subscribeqry->execute()) {
                                                        $subscribeqry->store_result();
                                
                                                        echo '<select name="newsletter" class="form-control" value="' . $customerNewsletter . '">';
                                                        while ($subscribeqry->fetch()) { 
                                                            $selected = "";
                                                            if ($customerNewsletter == $subscribeId) {
                                                                $selected = "selected";
                                                            } 
                                                    ?>
                                                        <option value="<?php echo $subscribeId; ?>"<?php echo $selected; ?>><?php echo $subscribeType; ?></option>
                                                        <?php
                                                        }
                                                        echo '</select>';
                                                    } ?>
                                                </div>
                                                <?php
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