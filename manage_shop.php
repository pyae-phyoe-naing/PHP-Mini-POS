<?php
require 'init.php';

if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}

$shop = getOne("select * from shop where id=1");
// update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $req = $_REQUEST;
    $errors = [];
    if (empty($req['name'])) {
        $errors['name'] = 'Shop name is required!';
    }
    
    if (empty($errors)) {
        $name = $req['name'];
        query("update shop set name=? where id=1",[$name]);
        setFlash('success', 'Shop update success');
        go('manage_shop.php');
        die();
    }
}
require 'include/header.php';
?>


<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-5">
    <div class="card col-8 offset-2">
        <div class="card-header card">
            <h4 class="text-white">Manage Shop</h4>
        </div>
        <div class="card-body">
            <?php flash('error'); ?>
            <?php flash('success', 'success') ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="">Shop Name</label>
                    <input type="text" value="<?php echo $shop->name ?>" name="name" class="form-control">
                    <?php isset($errors) ? validate($errors, 'name') : '' ?>

                </div>
                <button type="submit" class="btn btn-primary mr-3">Update</button>
                <a href="index.php" class="btn btn-outline-primary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php
require 'include/footer.php';

?>