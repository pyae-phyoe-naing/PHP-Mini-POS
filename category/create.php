<?php
require '../init.php';
require '../include/header.php';
if(!isset($_SESSION['user'])){
    setFlash('error','Please First Login');
    go('login.php');
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $errors = [];
    if(empty($name)){
        $errors['name'] = 'Name is required!';
    }
    if(empty($errors)){
        $slug = slug($name);
        $cond = query('insert into category (slug,name) values (?,?) ',[$slug,$name]);
        if($cond== 'success'){
            setFlash('success','Category create success');
        }else{
            setFlash('error','Category create fail!');
        }
    }
}
?>

<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h4 class="d-inline text-white">Category</h4>
                > Create
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <a class="btn btn-primary btn-sm" href="index.php"> All Category</a>
    <div class="card col-6 offset-3">
        <div class="card-header card"><h4 class="text-white">Create Category</h4></div>
        <div class="card-body">
            <?php flash('error'); ?>
            <?php flash('success','success'); ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label class="text-white" for="">Enter Name</label>
                    <input type="text" name="name" class="form-control">
                   <?php isset($errors) ? validate($errors,'name') : '' ?>
                </div>
                <button type="submit" class="btn btn-warning">Create</button>
            </form>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>