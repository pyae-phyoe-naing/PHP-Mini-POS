<?php
require '../init.php';
if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}
$category = getAll('select * from category');
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
    <a class="btn btn-primary btn-sm  float-right" href="index.php"> All Product</a>
    <div class="card col-6 offset-3">
        <div class="card-header card">
            <h4 class="text-white">Create Prodcut</h4>
        </div>
        <div class="card-body">
            <?php flash('error'); ?>
            <?php flash('success', 'success'); ?>
            <form action="" class="row" method="POST">
                <div class="col-6">
                    <h4 class="text-white">Product Info</h4>
                    <div class="form-group">
                        <label for="">Choose Category</label>
                        <select name="category_id" id="" class="form-control">
                        <?php foreach($category as $c){ ?>
                           <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                           <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" name="image" class="form-control p-1">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Description</label>
                        <textarea name="description"  class="form-control"></textarea>
                    </div>
                </div>
                <!-- Product Inventory -->
                <div class="col-6">
                    <h4 class="text-white">Inventory</h4>
                    <span class="text-info">
                      <span class="fas fa-info-circle text-primary"></span> For Sale Info
                   </span>
                    <div class="form-group">
                        <label for="">Enter Sale Price</label>
                        <input type="number" name="sale_price" class="form-control">
                    </div>
                   <span class="text-info">
                      <span class="fas fa-info-circle text-primary"></span> For Buy Info
                   </span>
                   <div class="form-group">
                        <label for="">Enter Total Quantity</label>
                        <input type="number" name="total_quantity" class="form-control">
                    </div>
                   <div class="form-group">
                        <label for="">Enter Buy Price</label>
                        <input type="number" name="buy_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="buy_date" class="form-control">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>