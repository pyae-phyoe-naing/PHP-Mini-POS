<?php
require 'init.php';

if (!isset($_SESSION['user'])) {
    setFlash('error', 'Please First Login');
    go('login.php');
    die();
}
// get current user
$id = $_SESSION['user']->id;
$current_user = getOne("select * from users where id=?", [$id]);
// update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $req = $_REQUEST;
    $errors = [];
    if (empty($req['name'])) {
        $errors['name'] = 'Username is required!';
    }
    if (empty($req['email'])) {
        $errors['email'] = 'Email is required!';
    } else {
        $chk = getOne("select * from users where email=? and id != $id", [$_POST['email']]);
        if ($chk) {
            $errors['email'] = 'Email သည် အသုံးပြုပီးသား ဖြစ်ပါသည်။';
        }
    }
    if (!empty($req['current_password'])) {
        if (!password_verify($req['current_password'], $current_user->password)) {
            $errors['current_password'] = 'Old Password မှားနေပါသည်။';
        } else {
            if (strlen($req['new_password']) < 6) {
                $errors['new_password'] = 'New Password သည်အနည်းဆုံး ၆ လုံး ဖြစ်ရန်လိုအပ်ပါသည်။';
            }
        }
    }
    if (empty($errors)) {
        $name = $req['name'];
        $email = $req['email'];
        if(!empty($req['current_password'])){
            $password = password_hash($req['new_password'],PASSWORD_BCRYPT);
        }else{
            $password = $current_user->password;
        }
        query("update users set name=?,email=?,password=? where id=?",[$name,$email,$password,$id]);
        setFlash('success', 'Update account success');
        go('manage_account.php');
        die();
    }
}
require 'include/header.php';
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
                    <input type="text" value="<?php echo $current_user->name ?>" name="name" class="form-control">
                    <?php isset($errors) ? validate($errors, 'name') : '' ?>

                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" value="<?php echo $current_user->email ?>" name="email" class="form-control">
                    <?php isset($errors) ? validate($errors, 'email') : '' ?>

                </div>
                <div class="form-group">
                    <label for="">Current Password</label>
                    <input type="password" name="current_password" class="form-control">
                    <?php isset($errors) ? validate($errors, 'current_password') : '' ?>

                </div>
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" name="new_password" class="form-control">
                    <?php isset($errors) ? validate($errors, 'new_password') : '' ?>

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