<?php
require '../init.php';

if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $req = $_REQUEST;
    $errors = [];
    if(empty($req['name'])){
        $errors['name'] = 'Username is required!';
    }
    if(empty($req['email'])){
        $errors['email'] = 'Email is required!';
    }
    if(empty($errors)){
        $name = $req['name'];
        $email = $req['email'];
       
        setFlash('success', 'Product Buy Add');
        go('create.php?slug='.$slug);
        die();   
    }
}
require '../include/header.php';
?>


<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card col-8 offset-2">
        <div class="card-header card">
            <h4 class="text-white">Manage Account</h4>
        </div>
        <div class="card-body">
            <?php flash('error'); ?>
            <?php flash('success', 'success') ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                    <?php isset($errors) ? validate($errors, 'name') : '' ?>

                </div>
                <div class="form-group">
                    <label for="">Emaily</label>
                    <input type="email" name="email" class="form-control">
                    <?php isset($errors) ? validate($errors, 'email') : '' ?>

                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password"  name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mr-3">Update</button>
                <a href="index.php"  class="btn btn-outline-primary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>