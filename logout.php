<?php
require 'init.php';
if(isset($_SESSION['user'])){
    session_unset();
}
go('login.php');