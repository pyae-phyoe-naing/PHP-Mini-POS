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
                <h5 class="d-inline text-white">Product Buy</h5>
                > Edit
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card col-8 offset-2">
        <div class="card-header card"><h4 class="text-white">Product Buy Edit</h4></div>
        <div class="card-body">       
            <?php flash('error'); ?>
            <?php flash('success','success') ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="">Buy Price</label>
                    <input type="number" name="buy_price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Total Quantity</label>
                    <input type="number" name="total_quantity" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Buy Date</label>
                    <input type="date" value="<?php echo date('Y-m-d') ?>" name="buy_date" class="form-control">
                </div>
                <button type="sumbit" class="btn btn-warning">Buy</button>
            </form>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>

