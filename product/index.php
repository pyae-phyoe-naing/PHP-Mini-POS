<?php
require '../init.php';
if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}

require '../include/header.php';

?>

<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h4 class="d-inline text-white">Product</h4>
                > Create
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-1">

    <a class="btn btn-primary btn-sm mt-2" href="create.php"> Create Product</a>

    <div class="card col-6 offset-3">
        <div class="card-header card">
            <?php flash('error'); ?>
            <?php flash('success', 'success') ?>
            <h4 class="text-white">All Prodcut</h4>
        </div>
        <div class="card-body">

        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>