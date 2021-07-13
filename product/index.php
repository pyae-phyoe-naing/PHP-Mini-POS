<?php
require '../init.php';
if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}
// paginate
if (isset($_GET['page'])) {
    paginateProduct(2);
    die();
}
// Search
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $data =  getAll("select * from product where name like '%$key%' order by id desc limit 2");
} else {
    $key = '';
    // get product
    $data =  getAll("select * from product order by id desc limit 2");
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
    <div class="container">
        <div class="d-flex justify-content-between mb-5">
            <a class="btn btn-primary btn-sm mt-3" href="create.php"> Create</a>
            <div class="w-50">
                <form action="" class="d-inline">
                    <div class="form-row ">
                        <div class="col-8">
                            <input type="text" value="<?php echo $key ?>" name="search" class="form-control ">
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                            <?php if ($key != '') { ?>
                                <a href='index.php' class="btn btn-danger">X</a>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card col-10 offset-1">
        <div class="card-header card">
            <?php flash('error'); ?>
            <?php flash('success', 'success') ?>
            <h4 class="text-white">All Prodcut</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($data)) { ?>
                <table class="table table-striped text-white">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Qty</th>
                            <th>Sale Price</th>
                            <th>Option</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php foreach ($data as $cat) {  ?>
                            <tr>
                                <td><?php echo $cat->name; ?></td>
                                <td>
                                    <img src="<?php echo $base_url . 'assets/img/' . $cat->image; ?>" width="55" height="55" alt="">
                                </td>
                                <td><?php echo $cat->total_quantity; ?></td>
                                <td><?php echo $cat->sale_price; ?></td>
                                <td>
                                    <a href=<?php echo $base_url . "product/detail.php?slug=" . $cat->slug; ?> class="btn btn-sm btn-success">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href=<?php echo $base_url . "product/edit.php?slug=" . $cat->slug; ?> class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure delete?');" href="<?php echo $base_url . "product/index.php?action=delete&slug=" . $cat->slug; ?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href=<?php echo $base_url . "product/sale.php?slug=" . $cat->slug; ?> class="btn btn-sm btn-outline-success">
                                        Sale
                                    </a>
                                    <a href=<?php echo $base_url . "product-buy/index.php?slug=" . $cat->slug; ?> class="btn btn-sm btn-outline-danger">
                                        Buy
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <button class="btn btn-warning" id='paginateBtn'>
                        <span class="fa fa-arrow-down"></span>
                    </button>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning mt-5 py-3">Category is empty!</div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>
<script>
    $(function() {
        var base = "<?php echo $base_url ?>";

        var page = 1;
        var tbody = $('#tbody');
        var paginateBtn = $('#paginateBtn');
        paginateBtn.click(function() {
            page += 1;
            // search
            var search = "<?php echo $key ?>";
            var url = `index.php?page=${page}`;
            if (search) {
                url += `&search=${search}`;
            }

            $.get(url).then(function(data) {
                //console.log(data);
                const res = JSON.parse(data);
                console.log(res);
                if (!res.length) {
                    $("#paginateBtn").attr("disabled", 'disabled');
                }
                var str = '';

                res.map(function(d) {
                    str += `
                 <tr>
                       <td>${d.name}</td>
                       <td>
                            <img src="${base}assets/img/${d.image}" width="55" height="55" alt="">
                        </td>
                        <td>${d.total_quantity}</td>
                        <td>${d.sale_price}</td>
                       <td>
                          <a href="detail.php?slug=${d.slug}" class="btn btn-sm btn-success">
                               <i class="fas fa-eye"></i>
                           </a>
                           <a href="edit.php?slug=${d.slug}" class="btn btn-sm btn-primary">
                               <i class="fas fa-edit"></i>
                           </a>
                         
                           <a onclick="return confirm('Are you sure delete?');" href="index.php?slug=${d.slug}" class="btn btn-sm btn-danger">
                               <i class="fas fa-trash-alt"></i>
                           </a>
                        </td>
                        <td>
                            <a href="sale.php?slug=${d.slug}" class="btn btn-sm btn-outline-success">
                                Sale
                            </a>
                            <a href="${base}product-buy/index.php?slug=${d.slug}" class="btn btn-sm btn-outline-danger">
                                Buy
                            </a>
                        </td>
                   </tr>
                `;
                });
                tbody.append(str);
            })

        })
    })
</script>