<?php
require '../init.php';
if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}
## get all product
$category = getAll('select * from category');
## get current product
if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $sql = "select * from product where slug=?";
    $data = getOne($sql, [$slug]);
    if (!$data) {
        setFlash('error', 'Product not found');
        go('index.php');
        die();
    }
} else {
    setFlash('error', 'Product not found');
    go('index.php');
    die();
}
## update product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['image'];
    $errors = [];
    if (empty($_POST['name'])) {
        $errors['name'] = 'Image is required!';
    }
    if (empty($_POST['description'])) {
        $errors['description'] = 'Image is required!';
    }
    if (empty($_POST['sale_price'])) {
        $errors['sale_price'] = 'Sale Price is required!';
    }

 
    if (!empty($file['name'])) {
        // check file size 1024b 1kb 1024kb => 1m
        $file_size =  $file['size'];
        $file_limit = 1024 * 1024 * 2;
        if ($file_limit < $file_size) {
            $errors['image'] = 'Image must be below 2mb!';
        }
    }
    if (empty($errors)) {
        ## get current product
        $current = getOne("select * from product where slug=?", [$_GET['slug']]);
        preety($current);
        ## check image has or not
        if (!empty($file['name'])) {
            ## delete old photo
            unlink('../assets/img/' . $current->image);
            ##upload image
            $tmp_name = $file['tmp_name'];
            $image = time() . str_replace(' ', '_', $file['name']);
            $path = '../assets/img/' . $image;
            move_uploaded_file($tmp_name, $path);
        } else {
            $image = $current->image;
        }

        $category_id = $_REQUEST['category_id'];
        $name = $_REQUEST['name'];
        $slug = slug($name);
        $description = $_REQUEST['description'];
        $sale_price = $_REQUEST['sale_price'];
        
       $cond = query(
            "update product set category_id=?,slug=?,name=?,description=?,image=?,sale_price=? where slug=?",
            [$category_id, $slug, $name, $description, $image,$sale_price,$current->slug]
        );
        if($cond){
            setFlash('success', 'Product update success');
            // go('index.php');
            // die();
            go('edit.php?slug='.$slug);
            die();
        }
       
    }
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
    <div class="card col-6 offset-3">
        <div class="card-header card d-inline">
            <a class="btn btn-danger btn-sm mr-3" href="index.php"> Back</a>

            <h4 class="text-white d-inline">Edit Prodcut</h4>
        </div>
        <div class="card-body">
            <?php flash('error'); ?>
            <?php flash('success', 'success'); ?>
            <form action="" class="row" method="POST" enctype="multipart/form-data">
                <div class="col-6">
                    <h4 class="text-white">Product Info</h4>
                    <div class="form-group">
                        <label for="">Choose Category</label>
                        <select name="category_id" id="" class="form-control">
                            <?php foreach ($category as $c) { ?>
                                <option <?php echo $data->category_id == $c->id ? 'selected' : '' ?> value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input value="<?php echo $data->name; ?>" type="text" name="name" class="form-control">
                        <?php isset($errors) ? validate($errors, 'name') : '' ?>
                    </div>
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" name="image" class="form-control p-1">
                        <?php isset($errors) ? validate($errors, 'image') : '' ?>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Description</label>
                        <textarea name="description" class="form-control"><?php echo $data->description; ?></textarea>
                        <?php isset($errors) ? validate($errors, 'description') : '' ?>
                    </div>
                </div>
                <!-- Product Inventory -->
                <div class="col-6">
                    <h4 class="text-white">Inventory</h4>
                    <span class="text-info">
                        <span class="fas fa-info-circle text-primary"></span> For Sale Info
                    </span>
                    <div class="form-group">
                        <label for="">Enter Sale Price</label>
                        <input value="<?php echo $data->sale_price; ?>" type="number" name="sale_price" class="form-control">
                        <?php isset($errors) ? validate($errors, 'sale_price') : '' ?>

                    </div>
                    <span class="text-info">
                        <span class="fas fa-image text-primary"></span> Product Image
                    </span>
                    <div class="form-group">
                        <p class="p-3">
                            <img src="<?php echo $base_url . 'assets/img/' . $data->image; ?>" class="img-thumbnail w-50" alt="">
                        </p>
                    </div>

                </div>
                <div class="col-12">
                    <input type="submit" value="Update" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>