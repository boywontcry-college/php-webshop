<?php
    include($_SERVER['DOCUMENT_ROOT'].'/core/header.php');

    $id = $_GET['id'];
?>

    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand">Creep's Webshop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="/admin/index">Enter using password</a></span>
            </div>
        </div>
    </nav>
    <?php 
    $liqry = $con->prepare("SELECT p.name, c.name, p.description, p.weight, p.color, p.price, i.image FROM product AS p, category AS c, image AS i WHERE p.category_id = c.category_id AND p.product_id = $id AND p.product_id = i.product_id");
    if ($liqry === false) {
        echo mysqli_error($con);
    } else {
        $liqry->bind_result($name, $category, $description, $weight, $color, $price, $image);
        if ($liqry->execute()) {
            $liqry->store_result();
            while ($liqry->fetch()) {
    ?>
    <div class="container">
        <main>
            <section id="product-container">
                <div id="product-wrapper">
                    <figure>
                        <img class="main-img" src="assets/img/<?php echo $image; ?>" alt="<?php echo $id; ?>">
                        <img class="side-img" src="assets/img/<?php echo $image; ?>" alt=<?php echo $id; ?>"">
                        <img class="side-img right" src="assets/img/<?php echo $image; ?>" alt="<?php echo $id; ?>">
                    </figure>
                    <div id="product-content">
                        <p id="product-title"><?php echo $name; ?></p>
                        <p id="product-category"><?php echo $category; ?></p>
                        <p id="product-description"><?php echo $description; ?></p>
                        <p id="product-weight"><?php echo $weight; ?></p>
                        <p id="product-color"><?php echo $color; ?></p>
                        <p id="product-price"><?php echo $price; ?><p>
                        <label for="quantity">Quantity: </label>
                        <div class="dec button">-</div>
                        <input type="text" id="product-quantity" name="quantity" value="1">
                        <div class="inc button">+</div>
                        <button class="btn btn-primary btn-block" type="submit" name="submit" value="add to cart">Add to cart</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <?php
            }
        }

        $liqry->close();
    }

    include($_SERVER['DOCUMENT_ROOT'].'/core/footer.php');
?>