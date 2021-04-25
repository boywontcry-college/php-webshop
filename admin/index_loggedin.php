<?php
    include('core/header.php');
    include('core/checklogin_admin.php');
?>
<h1>Welkom gebruiker <?php echo $_SESSION['Sadmin_id']; ?></h1>
- <a href="logout.php">uitloggen</a> <br>

<ul>
    <li><a href="users/">Gebruikers</a></li>
    <li><a href="orders/">Bestellingen</a></li>
    <li><a href="producten/">Producten</a></li>
</ul>
<?php
    include('core/footer.php');
?>