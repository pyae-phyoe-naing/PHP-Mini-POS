<?php
$conn = new PDO("mysql:host=localhost;dbname=mmc_pos","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

function query($sql,$params = []){
    global $conn;
    $stmt =  $conn->prepare($sql);
    $cond = $stmt->execute($params);
    if($cond){
        return 'success';
    }else{
        return 'fail';
    }
}

function getAll($sql,$params=[]){
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
function getOne($sql,$params=[]){
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_OBJ);
}
 