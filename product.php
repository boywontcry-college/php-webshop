<?php
    include($_SERVER['DOCUMENT_ROOT'].'/core/header.php');
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
    include($_SERVER['DOCUMENT_ROOT'].'/core/footer.php');
?>