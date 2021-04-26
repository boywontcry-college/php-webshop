<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="/">Creep's Webshop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="../users/">Administrators</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../products/">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="../categories/">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="../customers/">Customers</a></li>
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
						    <h2>Manage <b>Orders</b></h2>
					    </div>
					    <div class="col-sm-6">
						    <a href="add_product.php" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Product</span></a>						
					    </div>
				    </div>
			    </div>
			    <table class="table table-striped table-hover">
				    <thead>
                    <?php
                        $usiqry = $con->prepare("SELECT p.product_id, p.name, p.description, category_id, price, color, p.weight, active FROM product AS p");
                        if ($usiqry === false) {
                            trigger_error(mysqli_error($con));
                        } else {
                            $usiqry->bind_result($productId, $productName, $productDescription, $categoryId, $productPrice, $productColor, $productWeight, $productActive);
                            if ($usiqry->execute()) {
                                $usiqry->store_result();
                                echo '<tr>
                                      <th>Product ID</th>
                                      <th>Name</th>
                                      <th>Description</th>
                                      <th>Category ID</th>
                                      <th>Price</th>
                                      <th>Color</th>
                                      <th>Weight</th>
                                      <th>Active</th>
                                      <th>Actions</th>
                                      </tr>';
                                while ($usiqry->fetch() ) { ?>
				    </thead>
				    <tbody>
                    <tr>
                        <td><?php echo $productId; ?></td>
                        <td><?php echo $productName; ?></td>
                        <td><?php echo $productDescription; ?></td>
                        <td><?php echo $categoryId; ?></td>
                        <td>&euro;<?php echo $productPrice; ?></td>
                        <td><?php echo $productColor; ?></td>
                        <td><?php echo $productWeight; ?></td>
                        <td><?php echo $productActive; ?></td>
                        <td>
							<a href="edit_product.php?pid=<?php echo $productId; ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="delete_product.php?pid=<?php echo $productId; ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
