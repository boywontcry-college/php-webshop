<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="/">Creep's Webshop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="../users/">Administrators</a></li>
                    <li class="nav-item"><a class="nav-link" href="../products/">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="../categories/">Categories</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../customers/">Customers</a></li>
                </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="../logout.php">Log Out</a></span>
            </div>
        </div>
    </nav>

    <div class="container-xl">
	    <div class="table-responsive">
		    <div class="table-wrapper">
			    <div class="table-title">
				    <div class="row">
					    <div class="col-sm-6">
						    <h2>Manage <b>Customers</b></h2>
					    </div>
					    <div class="col-sm-6">
						    <a href="add_customer.php" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Customer</span></a>						
					    </div>
				    </div>
			    </div>
			    <table class="table table-striped table-hover">
				    <thead>
                    <?php
                        $usiqry = $con->prepare("SELECT c.customer_id, c.gender, c.first_name, c.middle_name, c.last_name, c.street, c.house_number, c.house_number_addon, c.zip_code, c.city, c.phone, c.emailadres, s.subscribe_type, c.date_added FROM customer AS c, gender AS g, subscribe AS s WHERE c.gender = g.gender_type AND c.newsletter_subscription = s.subscribe_id ORDER BY c.customer_id");
                        if ($usiqry === false) {
                            trigger_error(mysqli_error($con));
                        } else {
                            $usiqry->bind_result($customerId, $customerGender, $customerFirstName, $customerMiddleName, $customerLastName, $customerStreet, $customerHouseNumber, $customerHouseNumberAddon, $customerZipCode, $customerCity, $customerPhone, $customerEmail, $customerNewsletter, $customerDate);
                            if ($usiqry->execute()) {
                                $usiqry->store_result();
                                echo '<tr>
                                      <th>Customer ID</th>
                                      <th>Gender</th>
                                      <th>Name</th>
                                      <th>Adress</th>
                                      <th>Zip Code</th>
                                      <th>Phone</th>
                                      <th>E-mail</th>
                                      <th>Subbed</th>
                                      <th>Date added</th>
                                      <th>Actions</th>
                                      </tr>';
                                while ($usiqry->fetch() ) { ?>
				    </thead>
				    <tbody>
                    <tr>
                        <td><?php echo $customerId; ?></td>
                        <td><?php echo $customerGender; ?></td>
                        <td><?php echo $customerFirstName . " " . $customerMiddleName . " " . $customerLastName;  ?></td>
                        <td><?php echo $customerStreet . " " . $customerHouseNumber . $customerHouseNumberAddon; ?></td>
                        <td><?php echo $customerZipCode . ", " . $customerCity; ?></td>
                        <td><?php echo $customerPhone; ?></td>
                        <td><?php echo $customerEmail; ?></td>
                        <td><?php echo $customerNewsletter; ?></td>
                        <td><?php echo $customerDate; ?></td>
                        <td>
							<a href="edit_customer.php?cid=<?php echo $customerId; ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="delete_customer.php?cid=<?php echo $customerId; ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
                    </tr>
                    <?php
                                }
                                echo '</table>';
                            }
                        $usiqry->close();
                    } ?>					
				    </tbody>
			    </table>
		    </div>
	    </div>        
    </div>
<?php
    include('../core/footer.php');
?>
