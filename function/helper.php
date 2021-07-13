<?php

function setFlash($flash, $message)
{
    $_SESSION[$flash] = '';
    $_SESSION[$flash] = $message;
}
function flash($flash, $color = 'danger')
{

    if (!empty($_SESSION[$flash])) {
        echo "<div class='alert alert-$color'>$_SESSION[$flash]</div>";
        $_SESSION[$flash] = '';
    }
}
function validate($errors, $value)
{
    if (isset($errors[$value])) {
        echo "<small class='text text-danger'><strong>" . $errors[$value] . "</strong></small>";
    }
}
function preety($arr)
{
    echo "<pre>" . print_r($arr, true) . "</pre>";
}
function go($path)
{
    header("Location:$path");
}
function slug($str)
{
    return time() . str_replace(' ', '-', $str);
}

function paginateCategory($par_page = 5)
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 2;
    }
    if ($page <= 0) {
        $page = 2;
    }
    // paginate algorithms
    // page 1 =  0 - 5
    // page 2 =  5 - 5
    // page 3 =  10 - 5
    // ( page - 1  ) * par_page 
    //
    $start = ($page - 1) * $par_page;
    $limit = "$start,$par_page";
    $sql = "select * from category order by id desc limit $limit";
    $data = getAll($sql);
    echo json_encode($data);
}
function paginateProduct($par_page = 5)
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 2;
    }
    if ($page <= 0) {
        $page = 2;
    }

    $start = ($page - 1) * $par_page;
    $limit = "$start,$par_page";
    $sql = "select * from product ";

    if (isset($_GET['search']) and !empty($_GET['search'])) {
        $key = $_GET['search'];
        $sql .= "where name like '%$key%' ";
    }
        $sql .= "order by id desc limit $limit";
    
    $data = getAll($sql);
    echo json_encode($data);
}
// product buy
function paginatProductBuy($p_id,$par_page = 5)
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 2;
    }
    if ($page <= 0) {
        $page = 2;
    }

    $start = ($page - 1) * $par_page;
    $limit = "$start,$par_page";
    $sql = "select * from product_buy where product_id=$p_id order by id desc limit $limit";
    $data = getAll($sql);
    echo json_encode($data);
}