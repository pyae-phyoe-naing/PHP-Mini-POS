<?php
require '../init.php';

if(!isset($_SESSION['user'])){
    setFlash('error','Please First Login');
    go('../login.php');
    die();
}

require '../include/header.php';
?>

<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h5 class="d-inline text-white">Product</h5>
                > Buy
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card col-8 offset-2">
        <div class="card-header card"><h4 class="text-white">Product</h4></div>
        <div class="card-body">       
            <?php flash('error'); ?>
            <?php flash('success','success') ?>
            
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>

