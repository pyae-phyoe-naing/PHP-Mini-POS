<?php
require '../init.php';

if(!isset($_SESSION['user'])){
    setFlash('error','Please First Login');
    go('../login.php');
    die();
}
$slug = $_GET['slug'];
if(empty($slug)){
    setFlash('error','Product not found');
    go('../product/index.php');
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
            <?php flash('success','success') ?>
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>

