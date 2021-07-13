<?php
require 'init.php';
require 'include/header.php';
if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}
$date = date("Y-m-d");
// total sale
$total_sale = getOne("select sum(sale_price) as price from  product_sale where date=?", [$date])->price;
// total buy
$total_buy = getOne("select sum(buy_price * total_quantity) as price from  product_buy where buy_date=?", [$date])->price;
// net profit
$net_profit = $total_sale - $total_buy;
// lates sale list
$latest_sale = getAll(" SELECT product_sale.*,product.name as product_name FROM `product_sale` 
                        LEFT JOIN
                        product
                        ON
                        product_sale.product_id = product.id
                        WHERE 
                        product_sale.date='$date'
                        ORDER BY 
                        product_sale.id DESC
                        LIMIT 5
                        ");

// lates buy list
$latest_buy = getAll(" SELECT product_buy.*,product.name as product_name FROM `product_buy` 
                        LEFT JOIN
                        product
                        ON
                        product_buy.product_id = product.id
                        WHERE 
                        product_buy.buy_date='$date'
                        ORDER BY 
                        product_buy.id DESC
                        LIMIT 5
                        ");

?>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
        <div class="card-body">
            <?php flash('error') ?>
            <div class="row">
                <div class="col-4">
                    <div class="card" style="background-color:#34D399;">
                        <div class="card-body text-center text-white">
                            <p>Total Sale :</p>
                            <sapn class="badge badge-dark"><?php echo $total_sale; ?></sapn>

                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card bg-danger" ">
                      <div class=" card-body text-center text-white">
                        <p>Total Buy :</p>
                        <sapn class="badge badge-dark"><?php echo $total_buy; ?></sapn>

                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-primary">
                    <div class="card-body text-center text-white">
                        <p>Net Income :</p>
                        <sapn class="badge badge-dark"><?php echo $net_profit; ?></sapn>
                    </div>
                </div>
            </div>
        </div>
        <hr class="bg-white">
        <div class="row">
            <div class="col-6">
                <h4 class="text-success">Latest Sale List</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Sale</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                    <?php foreach($latest_sale as $ls){ ?>
                        <tr>
                            <td><?php echo $ls->product_name; ?></td>
                            <td><?php echo $ls->sale_price; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <h4 class="text-danger">Latest Buy List</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Sale</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                    <?php foreach($latest_buy as $ls){ ?>
                        <tr>
                            <td><?php echo $ls->product_name; ?></td>
                            <td><?php echo $ls->buy_price; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php
require 'include/footer.php';

?>