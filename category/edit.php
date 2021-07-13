<?php
require '../init.php';
require '../include/header.php';
if(!isset($_SESSION['user'])){
    setFlash('error','Please First Login');
    go('../login.php');
    die();
}
// Update category
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $errors = [];
    if(empty($name)){
        $errors['name'] = 'Name is required!';
    }
    if(empty($errors)){
         query('update category set slug=?,name=? where slug=?',[slug($name),$name,$_GET['slug']]);
         setFlash('success','Category update success');
         go("index.php");
         die();
    }
}
// GET slug
if(isset($_GET['slug'])){
    $slug = $_GET['slug'];
    $sql = "select * from category where slug=?";
    $cat = getOne($sql,[$slug]);
    if(!$cat){
        setFlash('error','Category not found');
        go('index.php');
        die();
    }
}else{
    setFlash('error','Category not found');
    go('index.php');
    die();
}

?>

<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h4 class="d-inline text-white">Category</h4>
                > Edit
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card col-8 offset-2">
        <div class="card-body">
            <a href="<?php echo $base_url; ?>/category/index.php" class="btn btn-sm btn-danger mb-3">All Category</a>
            <?php flash('error'); ?>
            <?php flash('success','success'); ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label class="text-white" for="">Enter Name</label>
                    <input type="text" name="name" value="<?php echo $cat->name; ?>" class="form-control">
                   <?php isset($errors) ? validate($errors,'name') : '' ?>
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>