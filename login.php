<?php
require 'init.php';
if(isset($_SESSION['user'])){
    setFlash('error','Already login');
    go('index.php');
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $email = $_POST['email'];
   $password = $_POST['password'];
   $errors = [];
   $user = getOne('select * from users where email=?',[$email]);
   if(empty($email)){
        $errors['email'] = 'Email ဖြည့်ရန်လိုအပ်ပါသည်။';
   }else{
    if(!$user){
        $errors['email'] = 'Email မှားနေပါသည်။';
     }else{
        if(!password_verify($password,$user->password)){
          $errors['password'] = 'Password မှားနေပါသည်။';
        }
     }
   }
   if(empty($password)){
    $errors['password'] = 'Password ဖြည့်ရန်လိုအပ်ပါသည်။';
   }
   
   if(empty($errors)){
      $_SESSION['user'] = $user;
      go('index.php');
   }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/argon-design-system.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container  my-5">
      <div class="row justify-content-center">
        <div class="col-md-6 ">
          <div class="card border-0 shadow">
            <div class="card-header bg-dark text-white"><h4 class="text-white">Login</h4></div>
            <div class="card-body p-5">
            <?php flash('error'); ?>
              <form action="" method="post">
                <div class="form-group">
                  <label for="">Enter Email</label>
                  <input type="text" name="email" class="form-control" />
                  <?php isset($errors) ? validate($errors,'email') : '' ?>
                </div>
                <!-- password -->
                <div class="form-group">
                  <label for="">Enter Password</label>
                  <input type="text" name="password" class="form-control" />
                  <?php isset($errors) ? validate($errors,'password') : '' ?>
                </div>
                <input type="submit" value="Login" name="submit" class="btn btn-primary mt-3" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
