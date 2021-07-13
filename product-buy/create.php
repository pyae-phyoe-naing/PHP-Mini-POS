<?php
require '../init.php';

if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('../login.php');
    die();
}
$slug = $_GET['slug'];
if (empty($slug)) {
    setFlash('error', 'Product not found');
    go('../product/index.php');
    die();
} else {
    $product = getOne("select id,total_quantity from product where slug=?", [$slug]);
    if (!$product) {
            setFlash('error', 'Product not found');
            go('../product/index.php');
            die();     
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $req = $_REQUEST;
        $errors = [];
        if(empty($req['buy_price'])){
            $errors['buy_price'] = 'Buy price is required!';
        }
        if(empty($req['total_quantity'])){
            $errors['total_quantity'] = 'Quantity is required!';
        }
        if(empty($errors)){
            $buy_price = $req['buy_price'];
            $total_quantity = $req['total_quantity'];
            $buy_date = $req['buy_date'];
            ## insert 
            query("insert into product_buy (product_id,buy_price,total_quantity,buy_date) values (?,?,?,?)",
            [$product->id,$buy_price,$total_quantity,$buy_date]);
            ## sum original qty + new qty
            $total_qty = $product->total_quantity + $total_quantity;
            query("update product set total_quantity=? where slug=?",[$total_qty,$slug]);
            setFlash('success', 'Product Buy Add');
            go('create.php?slug='.$slug);
            die();   
        }
    }
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
        <div class="card-header card">
            <h4 class="text-white">Product Buy</h4>
        </div>
        <div class="card-body">
            <?php flash('error'); ?>
            <?php flash('success', 'success') ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="">Buy Price</label>
                    <input type="number" name="buy_price" class="form-control">
                    <?php isset($errors) ? validate($errors, 'buy_price') : '' ?>

                </div>
                <div class="form-group">
                    <label for="">Total Quantity</label>
                    <input type="number" name="total_quantity" class="form-control">
                    <?php isset($errors) ? validate($errors, 'total_quantity') : '' ?>

                </div>
                <div class="form-group">
                    <label for="">Buy Date</label>
                    <input type="date" value="<?php echo date('Y-m-d') ?>" name="buy_date" class="form-control">
                </div>
                <button type="submit" class="btn btn-warning mr-3">Buy</button>
                <a href="index.php?slug=.<?php echo $slug;?>"  class="btn btn-outline-warning">Back</a>
            </form>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>