<?php
function setFlash($flash,$message){
   $_SESSION[$flash] = '';
   $_SESSION[$flash] = $message;
}
function flash($flash,$color='danger'){

  if(!empty($_SESSION[$flash])){
      echo "<div class='alert alert-$color'>$_SESSION[$flash]</div>";
      $_SESSION[$flash] = '';
  }
}
function validate($errors,$value){
   if(isset($errors[$value])){
       echo "<small class='text text-danger'><strong>". $errors[$value]."</strong></small>";
     } 
}
function preety($arr){
    echo "<pre>".print_r($arr,true)."</pre>";
}
function go($path){
    header("Location:$path");
}
function slug($str){
    return time().str_replace(' ','-',$str);
}