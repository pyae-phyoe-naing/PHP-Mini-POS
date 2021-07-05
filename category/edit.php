<?php
require '../init.php';
require '../include/header.php';
if(!isset($_SESSION['user'])){
    setError('error','Please First Login');
    go('login.php');
}

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
    <div class="card">
        <div class="card-body">
            <a href="" class="btn btn-sm btn-success mb-3">Create</a>
           <table class="table table-striped text-white">
               <thead>
                   <tr>
                       <th>Name</th>
                       <th>Option</th>
                   </tr>
               </thead>
               <tbody>
                   <tr>
                       <td>Cat One</td>
                       <td>
                           <a href="" class="btn btn-sm btn-primary">
                               <i class="fas fa-edit"></i>
                           </a>
                           <a href="" class="btn btn-sm btn-danger">
                               <i class="fas fa-trash-alt"></i>
                           </a>
                        </td>
                   </tr>
               </tbody>
           </table>
        </div>
    </div>
</div>

<?php
require '../include/footer.php';

?>