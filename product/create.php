<?php
require '../init.php';
if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}
$category = getAll('select * from category');
if($_SERVER['REQUEST_METHOD']=='POST'){
   $file = $_FILES['image'];
   $errors = [];
   if(empty($_POST['name'])){
      $errors['name'] = 'Image is required!';
   }
   if(empty($_POST['description'])){
    $errors['description'] = 'Image is required!';
   }
   if(empty($_POST['sale_price'])){
    $errors['sale_price'] = 'Sale Price is required!';
   }
   if(empty($_POST['buy_price'])){
    $errors['buy_price'] = 'Buy Price is required!';
   }
   if(empty($_POST['total_quantity'])){
    $errors['total_quantity'] = 'Quantity is required!';
   }
   if(empty($file['name'])){
      $errors['image'] = 'Image is required!';
   }else{
        // check file size 1024b 1kb 1024kb => 1m
     $file_size =  $file['size'];
     $file_limit = 1024*1024*2;
     if($file_limit < $file_size){
      $errors['image'] = 'Image must be below 2mb!';
     }
   }
   if(empty($errors)){
       print_r($_REQUEST);
   }
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
    <a class="btn btn-primary btn-sm  float-right" href="index.php"> All Product</a>
    <div class="card col-6 offset-3">
        <div class="card-header card">
            <h4 class="text-white">Create Prodcut</h4>
        </div>
        <div class="card-body">
            <?php flash('error'); ?>
            <?php flash('success', 'success'); ?>
            <form action="" class="row" method="POST" enctype="multipart/form-data">
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
                        <?php isset($errors) ? validate($errors,'name') : '' ?>
                    </div>
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" name="image" class="form-control p-1">
                        <?php isset($errors) ? validate($errors,'image') : '' ?>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Description</label>
                        <textarea name="description"  class="form-control"></textarea>
                        <?php isset($errors) ? validate($errors,'name') : '' ?>
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
                        <?php isset($errors) ? validate($errors,'sale_price') : '' ?>

                    </div>
                   <span class="text-info">
                      <span class="fas fa-info-circle text-primary"></span> For Buy Info
                   </span>
                   <div class="form-group">
                        <label for="">Enter Total Quantity</label>
                        <input type="number" name="total_quantity" class="form-control">
                        <?php isset($errors) ? validate($errors,'total_quantity') : '' ?>

                    </div>
                   <div class="form-group">
                        <label for="">Enter Buy Price</label>
                        <input type="number" name="buy_price" class="form-control">
                        <?php isset($errors) ? validate($errors,'buy_price') : '' ?>

                    </div>
                    <div class="form-group">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="buy_date" class="form-control">
                    </div>
                </div>
                <div class="col-12">
                   <input type="submit" value="Create" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>