<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/core/header.php');

    $limit = mysqli_query($con, "SELECT MAX(p.product_id) FROM product AS p LIMIT 1");
?>

<nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
    <div class="container"><a class="navbar-brand">Creep's Webshop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="/admin/index">Enter using password</a></span>
        </div>
    </div>
</nav>
<div class="container">
    <main>
        <section id="product-container">
            <?php
            $liqry = $con->prepare("SELECT DISTINCT i.product_id, p.product_id, p.name, p.price, i.image FROM product AS p, image AS i WHERE p.active = 1 AND i.active = 1 AND p.product_id = i.product_id ORDER BY RAND()");
            if ($liqry === false) {
                echo mysqli_error($con);
            } else {
                $liqry->bind_result($productId, $id, $name, $price, $imagePath);
                if ($liqry->execute()) {
                    $liqry->store_result();
                    while ($liqry->fetch()) { 
            ?>
                        <article class="product-card" onclick="location.href='product?id=<?php echo $id; ?>'">
                            <figure>
                                <img src="assets/img/<?php echo $imagePath; ?>" alt="<?php echo $id; ?>">
                                <figcaption>
                                    <p class="title"><?php echo $name; ?></p>
                                </figcaption>
                            </figure>
                            <p class="product-content"><strong><span class="product-price"><?php echo $price; ?></span></strong></p>
                        </article>
            <?php  
                    }
                }
                $liqry->close();
            }
            ?>
        </section>
    </main>
</div>
<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/core/footer.php');
?>