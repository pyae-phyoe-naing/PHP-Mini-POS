<?php
require '../init.php';

if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}
// get product
if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $chk = getOne("select * from product where slug=?", [$slug]);
    if (empty($chk)) {
        setFlash('error', 'Product not found!');
        go('index.php');
        die();
    } else {
        $data = getOne(
            "SELECT product.*,category.name as category_name,
               (select COUNT(id) from product_sale WHERE product_sale.product_id = product.id) as sale_count 
                FROM `product`
                LEFT JOIN
                category
                ON
                product.category_id = category.id
                WHERE product.slug=?",
                [$slug]
        );
      //  preety($data);
    }
} else {
    setFlash('error', 'Product not found!');
    go('index.php');
    die();
}
require '../include/header.php';
?>

<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h4 class="d-inline text-white">Category</h4>
                > All
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">

    <div class="card col-8 offset-2">
        <div class="card-header card d-inline">
            <a href="index.php" class="btn btn-sm btn-danger mb-3 d-inline">Back</a>

        </div>
        <div class="card-body">
            <div class="row">
                <!-- image -->
                <div class="col-3">
                    <img src="<?php echo $base_url . 'assets/img/' . $data->image; ?>" class="img-thumbnail w-100" alt="">
                </div>
                <div class="col-9">
                    <div class="card bg-dark p-3">
                        <h4 class="text-white"><?php echo $data->name ?></h4>
                        <div>
                            Category : <span class="badge bg-primary text-white"><?php echo $data->category_name; ?></span>
                        </div>
                        <div class="rounded bg-primary p-3 mt-3 text-white">
                            <table class="table  text-white">
                                <thead>
                                    <tr>
                                        <th>Sale Coutnt</th>
                                        <th>Sale Price</th>
                                        <th>Remain Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $data->sale_count; ?></td>
                                        <td><?php echo $data->sale_price; ?></td>
                                        <td><?php echo $data->total_quantity; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 bg-primary p-3">
                            <p class="text-white"><?php echo $data->description; ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>