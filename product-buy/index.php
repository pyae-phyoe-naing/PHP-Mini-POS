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
}
if (isset($_GET['action'])) {
    $id = $_GET['id'];
    $product_buy_data = getOne("select * from product_buy where id=?", [$id]);
    $product_data = getOne("select * from product where slug=?", [$_GET['slug']]);
    $total_qty = $product_data->total_quantity - $product_buy_data->total_quantity;
    query("delete from product_buy where id=?", [$id]);
    query("update product set total_quantity=? where slug=?", [$total_qty, $_GET['slug']]);
    setFlash('success', 'Product Buy Delete');
    go('index.php?slug='.$_GET['slug']);
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
        <div class="card-header card d-inline">
            <h4 class="text-white d-inline">Product</h4>
            <a href="create.php?slug=<?php echo $slug; ?>" class="float-right btn btn-danger">create</a>
        </div>
        <div class="card-body">
            <?php flash('error'); ?>
            <?php flash('success', 'success') ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Buy Price</th>
                        <th>Buy Quantity</th>
                        <th>Buy Date</th>
                        <th> Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $product = getOne("select * from product where slug=?", [$slug]);
                    $buy = getAll("select * from product_buy where product_id=$product->id");
                    $i = 1;
                    foreach ($buy as $b) {
                    ?>
                        <tr class="text-white">
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $b->buy_price; ?></td>
                            <td><?php echo $b->total_quantity; ?></td>
                            <td><?php echo $b->buy_date; ?></td>
                            <td>
                                <a href="index.php?action=delete&slug=<?php echo $slug; ?>&id=<?php echo $b->id; ?>" onclick="return confirm('Are you sure delete?')" class="btn btn-danger btn-sm">
                                    <span class="fa fa-trash-alt"></span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>