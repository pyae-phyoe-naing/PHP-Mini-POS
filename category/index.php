<?php
require '../init.php';
require '../include/header.php';
if(!isset($_SESSION['user'])){
    setFlash('error','Please First Login');
    go('login.php');
}
// Category Delete
if(isset($_GET['action'])){
    $slug =  $_GET['slug'];
   query("delete from category where slug=?",[$slug]);
    setFlash('success','Category Delete Success!');
 
 }

$data =  getAll("select * from category order by id desc limit 2");


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
        <div class="card-body">
            <a href="create.php" class="btn btn-sm btn-success mb-3">Create</a>
            <?php flash('error'); ?>
            <?php flash('success','success') ?>
            <?php if(!empty($data)){ ?>
           <table class="table table-striped text-white">
               <thead>
                   <tr>
                       <th>Name</th>
                       <th>Option</th>
                   </tr>
               </thead>
               <tbody>
                   <?php  foreach($data as $cat){  ?>
                   <tr>
                       <td><?php echo $cat->name; ?></td>
                       <td>
                           <a href=<?php echo $base_url."category/edit.php?slug=".$cat->slug; ?> class="btn btn-sm btn-primary">
                               <i class="fas fa-edit"></i>
                           </a>
                           <a onclick="return confirm('Are you sure delete?');" href="<?php echo $base_url."category/index.php?action=delete&slug=".$cat->slug; ?>" class="btn btn-sm btn-danger">
                               <i class="fas fa-trash-alt"></i>
                           </a>
                        </td>
                   </tr>
                  <?php } ?>
               </tbody>
           </table>
           <div class="text-center">
               <button class="btn btn-warning">
                  <span class="fa fa-arrow-down"></span>
               </button>
           </div>
           <?php }else{ ?>
            <div class="alert alert-warning mt-5 py-3">Category is empty!</div>
           <?php } ?>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>