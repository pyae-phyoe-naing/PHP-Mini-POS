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

// paginate
if(isset($_GET['page'])){
    $p_id = getOne("select id from product where slug='$slug'")->id;
    paginatProductSale($p_id,3);
    die();
}

// get sale
$product = getOne("select * from product where slug=?", [$slug]);
$sale = getAll("select *,(select name from product where product.id=product_sale.product_id) as name
 from product_sale where product_id=$product->id order by id desc limit 3");

require '../include/header.php';
?>

<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h5 class="d-inline text-white">Product</h5>
                > Sale
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card col-8 offset-2">
        <div class="card-header card d-inline">
            <a href="<?php echo $base_url?>/product/index.php" class="btn btn-danger btn-sm">Back</a>
            <h4 class="text-white d-inline ml-3">Product Sale List</h4>
        </div>
        <div class="card-body">
            <?php flash('error'); ?>
            <?php flash('success', 'success') ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Buy Price</th>
                        <th>Sale Price</th>
                        <th>Sale Date</th>

                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php

                    foreach ($sale as $b) {
                    ?>
                        <tr class="text-white">

                            <td><?php echo $b->name; ?></td>
                            <td><?php echo $b->sale_price; ?></td>
                            <td><?php echo $b->date; ?></td>
                           
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-center">
                <button class="btn btn-primary" id='paginateBtn'>
                    <span class="fa fa-arrow-down"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>
<script>
    $(function() {
        var page = 1;
        var tbody = $('#tbody');
        var paginateBtn = $('#paginateBtn');
        var slug = "<?php echo $_GET['slug'] ?>";

        paginateBtn.click(function() {
            page += 1;
            $.get(`index.php?slug=${slug}&page=${page}`).then(function(data) {
                console.log(data);
                const res = JSON.parse(data);
                if (!res.length) {
                    $("#paginateBtn").attr("disabled", 'disabled');
                }
                var str = '';
                res.map(function(d) {
                    str += `
                 <tr class='text-white'>
                       <td>${d.name}</td>
                       <td>${d.sale_price}</td>
                       <td>${d.date}</td>
                      
                   </tr>
                `;
                });
                tbody.append(str);
            })

        })
    })
</script>